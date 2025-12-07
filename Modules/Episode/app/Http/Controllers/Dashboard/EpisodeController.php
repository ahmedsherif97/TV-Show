<?php

namespace Modules\Episode\App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Episode\App\Models\Episode;
use Modules\TVShow\App\Models\TVShow;

class EpisodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list episode')->only(['index', 'datatable']);
        $this->middleware('permission:show episode')->only(['show']);
        $this->middleware('permission:create episode')->only(['create', 'store']);
        $this->middleware('permission:update episode')->only(['edit', 'update', 'video', 'uploadVideo', 'deleteVideo']);
        $this->middleware('permission:delete episode')->only(['destroy']);
        $this->middleware(\App\Http\Middleware\DataTableMiddleware::class)->only('datatable');
    }

    public function index()
    {
        return view('episode::dashboard.index', [
            'title' => __('episode::dashboard.episodes'),
            'result' => []
        ]);
    }

    public function datatable()
    {
        $html = view('episode::dashboard.datatable', [
            'result' => $result = Episode::query()
                ->with('tvShow')
                ->when(request('search'), function ($q) {
                    $term = '%' . request('search') . '%';
                    $q->where('title', 'LIKE', $term)
                        ->orWhere('slug', 'LIKE', $term);
                })
                ->orderBy(request('orderBy', 'id'), request('orderAs', 'desc'))
                ->paginate(request('perPage', 10))
        ]);

        return viewToDatatable($html, $result);
    }

    public function create()
    {
        $tvShows = TVShow::orderBy('title')->pluck('title', 'id');

        return view('episode::dashboard.create', [
            'title' => __('episode::dashboard.create'),
            'tvShows' => $tvShows,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tv_show_id' => 'required|exists:tv_shows,id',
            'title' => 'required|string|min:2|max:255',
            'slug' => 'required|string|max:255|unique:episodes,slug',
            'description' => 'nullable|string',
            'airing_at' => 'nullable|date',
            'published_at' => 'nullable|date',
        ]);

        $episode = Episode::create($data);

        if ($request->hasFile('thumbnail')) {
            $episode->clearMediaCollection('thumbnail');
            $episode->addMediaFromRequest('thumbnail')->toMediaCollection('thumbnail');
        }

        return back()->with('alert-success', trans('dashboard.create.success'));
    }

    public function show(Episode $episode)
    {
        $episode->load(['tvShow', 'media']);

        return view('episode::dashboard.show', [
            'title' => __('episode::dashboard.show'),
            'episode' => $episode
        ]);
    }

    public function edit(Episode $episode)
    {
        $tvShows = TVShow::orderBy('title')->pluck('title', 'id');
        $episode->load('tvShow');

        return view('episode::dashboard.edit', [
            'title' => __('dashboard.update'),
            'episode' => $episode,
            'tvShows' => $tvShows,
        ]);
    }

    public function update(Request $request, Episode $episode)
    {
        $data = $request->validate([
            'tv_show_id' => 'required|exists:tv_shows,id',
            'title' => 'required|string|min:2|max:255',
            'slug' => 'required|string|max:255|unique:episodes,slug,' . $episode->id,
            'description' => 'nullable|string',
            'airing_at' => 'nullable|date',
            'published_at' => 'nullable|date',
        ]);

        $episode->update($data);

        if ($request->hasFile('thumbnail')) {
            $episode->clearMediaCollection('thumbnail');
            $episode->addMediaFromRequest('thumbnail')->toMediaCollection('thumbnail');
        }

        return back()->with('alert-success', trans('dashboard.create.success'));
    }

    public function destroy(Episode $episode)
    {
        $episode->delete();

        return back()->with('alert-success', trans('dashboard.delete.success'));
    }

    public function video($episodeId)
    {
        $episode = Episode::with('media', 'tvShow')->findOrFail($episodeId);

        return view('episode::dashboard.video', [
            'title' => __('episode::dashboard.video'),
            'episode' => $episode,
        ]);
    }

    public function uploadVideo(Request $request, $episodeId)
    {
        set_time_limit(3600);
        ini_set('memory_limit', '1G');
        ini_set('post_max_size', '2048M');
        ini_set('upload_max_filesize', '2048M');

        $episode = Episode::findOrFail($episodeId);

        $request->validate([
            'file' => 'required|file',
            'dzchunkindex' => 'required|integer',
            'dztotalchunkcount' => 'required|integer',
            'dzuuid' => 'required|string',
        ]);

        try {
            $file = $request->file('file');
            $chunkIndex = (int)$request->input('dzchunkindex');
            $totalChunks = (int)$request->input('dztotalchunkcount');
            $uuid = $request->input('dzuuid');

            $tempDir = storage_path("app/public/uploads/episodes/temp/{$uuid}");
            if (!is_dir($tempDir)) {
                mkdir($tempDir, 0777, true);
            }

            $file->move($tempDir, $chunkIndex);

            if ($chunkIndex + 1 === $totalChunks) {
                $originalName = $file->getClientOriginalName() ?: "episode_{$episodeId}_" . time() . '.mp4';
                $finalPath = storage_path('app/public/uploads/episodes/' . $originalName);

                if (!is_dir(dirname($finalPath))) {
                    mkdir(dirname($finalPath), 0777, true);
                }

                $this->mergeChunks($tempDir, $finalPath);

                $duration = $this->getVideoDurationInSeconds($finalPath);
                if ($duration !== null) {
                    $episode->duration_seconds = $duration;
                    $episode->save();
                }

                $episode->clearMediaCollection('video');
                $media = $episode
                    ->addMedia($finalPath)
                    ->usingFileName($originalName)
                    ->toMediaCollection('video');

                if (file_exists($finalPath)) {
                    unlink($finalPath);
                }

                $this->deleteDirectory($tempDir);

                return response()->json([
                    'success' => true,
                    'message' => 'Video uploaded successfully.',
                    'media_id' => $media->id,
                    'media_url' => $media->getUrl(),
                    'duration' => $episode->duration_seconds,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Chunk uploaded.',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function deleteVideo($episodeId)
    {
        $episode = Episode::findOrFail($episodeId);

        try {
            $episode->clearMediaCollection('video');
            $episode->duration_seconds = 0;
            $episode->save();

            return response()->json([
                'success' => true,
                'message' => 'Video deleted successfully.',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    private function mergeChunks($tempDir, $finalPath)
    {
        $files = glob($tempDir . '/*');
        natsort($files);

        $final = fopen($finalPath, 'wb');
        foreach ($files as $file) {
            $chunk = fopen($file, 'rb');
            stream_copy_to_stream($chunk, $final);
            fclose($chunk);
        }
        fclose($final);
    }

    private function deleteDirectory($dir)
    {
        if (!is_dir($dir)) {
            return;
        }

        foreach (scandir($dir) as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }

            $path = $dir . DIRECTORY_SEPARATOR . $item;

            if (is_dir($path)) {
                $this->deleteDirectory($path);
            } else {
                unlink($path);
            }
        }

        rmdir($dir);
    }

    private function getVideoDurationInSeconds($path)
    {
        $cmd = 'ffprobe -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 "' . $path . '"';
        $output = @shell_exec($cmd);
        if (!$output) {
            return null;
        }
        $seconds = (float)trim($output);
        if ($seconds <= 0) {
            return null;
        }
        return (int)round($seconds);
    }

    public function updateDuration(Request $request, $episodeId)
    {
        $episode = Episode::findOrFail($episodeId);

        $data = $request->validate([
            'duration' => 'required|numeric|min:0',
        ]);

        $episode->duration_seconds = (int)round($data['duration']);
        $episode->save();

        return response()->json([
            'success' => true,
            'duration' => $episode->duration_seconds,
        ]);
    }

}
