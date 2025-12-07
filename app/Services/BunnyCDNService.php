<?php

namespace App\Services;

use Corbpie\BunnyCdn\BunnyAPI;
use Corbpie\BunnyCdn\BunnyAPIStream;
use Modules\Course\App\Models\Course;
use Modules\Lesson\App\Models\Lesson;

class BunnyCDNService
{
    private static BunnyAPIStream $bunnyAPIStream;

    public static function newInstance(): self
    {
        self::$bunnyAPIStream = new BunnyAPIStream();
        self::$bunnyAPIStream->streamLibraryAccessKey(config('bunny_cdn.api_key'));
        self::$bunnyAPIStream->setStreamLibraryId(config('bunny_cdn.library_id'));

        return new self();
    }

    public function deleteOldVideo($lesson)
    {
        if ($lesson->video_guid)
            self::$bunnyAPIStream->deleteVideo($lesson->video_guid);

    }

    private function uploadVideoCurl(string $file, string $videoGuid): void
    {
        $libraryId = config('bunny_cdn.library_id');

        $ch = curl_init();

        $data = fopen($file, 'r');

        curl_setopt($ch, CURLOPT_URL, (new \ReflectionClass(BunnyAPI::class))->getConstant('VIDEO_STREAM_URL') . "library/{$libraryId}/videos/" . $videoGuid);
        curl_setopt($ch, CURLOPT_PUT, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_INFILE, $data);
        curl_setopt($ch, CURLOPT_INFILESIZE, filesize($file));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'AccessKey: ' . config('bunny_cdn.api_key'), // Add your BunnyCDN API key here
            'Content-Type: application/octet-stream',
        ]);

        curl_exec($ch);
        $error = curl_error($ch);

        curl_close($ch);
        fclose($data);

        if ($error) {
            throw new \RuntimeException($error);
        }
    }

    public function uploadVideo(Course $course, string $title, string $file): string
    {
        self::$bunnyAPIStream->setStreamCollectionGuid($this->getCollectionId($course));

        $video = self::$bunnyAPIStream->createVideoForCollection($title);

        $this->uploadVideoCurl($file, $video['guid']);

        return $video['guid'];
    }

    private function getCollectionId(Course $course): string
    {
        if ($course->collection_id === null) {
            $collection = self::$bunnyAPIStream->createCollection($course->name);
            $course->update([
                'collection_id' => $collection['guid']
            ]);
            $collectionId = $collection['guid'];
        } else {
            $collectionId = $course->collection_id;
        }

        return $collectionId;
    }

    public static function embedUrl(Lesson $lesson): string
    {
        return "https://iframe.mediadelivery.net/embed/" . config('bunny_cdn.library_id') . "/{$lesson->video_guid}?loop=false&muted=false&preload=true&responsive=true";
    }

    public function getBunnyService(): BunnyAPIStream
    {
        return self::$bunnyAPIStream;
    }
}
