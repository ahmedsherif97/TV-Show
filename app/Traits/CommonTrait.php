<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait CommonTrait
{
    public function uploadFile(string $inputName = 'file', string $folder = '', $validation = 'required|image|mimes:jpeg,jpg,png|max:3000', $disk = 'uploads')
    {
        set_time_limit(3600);
        ini_set('max_execution_time', -1);
        ini_set('memory_limit', -1);
        ini_set('post_max_size', '250M');
        ini_set('upload_max_filesize', '250M');

        // validate file
        request()->validate([$inputName => $validation]);

        // remove any / char form var
        $path = "/" . trim($folder, '/');

        // check has file
        if (request()->hasFile($inputName)) {

            $file = request()->file($inputName);

            $filename = $this->nameFile($inputName, $file);

            //Should use though "storage" to create nested folders if not found
            Storage::disk($disk)->put($fullPath = "$path/$filename", $file->get());

            // to show full url
            //return Storage::disk('uploads')->url($fullPath);

            //return file directory without domain name for clean store
            return '/' . $disk . $fullPath;
        }

        return NULL;
    }

    private function nameFile(string $inputName, $file): string
    {
        if ($inputName == 'logo') {
            $fileName = 'logo.png';
        } else {
            $fileName = time() . '.' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
        }
        return $fileName;
    }

    public function successResponse(?string $message = null, ?array $data = [], ?array $errors = null, ?int $code = 200)
    {
        return response()->json([
            'status' => true,
            //'code'    => $code,
            'message' => $message ?? '',
            'result' => (object)$data,
            'errors' => $errors ?? [],
        ], $code);
    }

    public function errorResponse(?string $message = null, ?array $data = [], ?array $errors = null, ?int $code = 400)
    {
        return response()->json([
            'status' => false,
            //'code'    => $code,
            'message' => $message ?? '',
            'result' => (object)$data ?? NULL,
            'errors' => $errors ?? [],
        ], $code);
    }
}
