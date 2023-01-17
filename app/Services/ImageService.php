<?php

namespace App\Services;

use App\Services\Contracts\ImageServiceContract;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageService implements ImageServiceContract
{
    public static function uploadImage(UploadedFile|string $file)
    {
        if (is_string($file)) {
            return $file;
        }

        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $fileDir = 'images/';
        $filePath = public_path($fileDir) . $fileName;

        Image::make($file)
            ->resize(300, 300, function ($img) {
                $img->upsize();
            })
            ->save($filePath, 80, 'jpg');

        return $fileDir . $fileName;
    }

    public static function uploadPreview(UploadedFile|string $file)
    {
        if (is_string($file)) {
            return $file;
        }

        $fileName = 'prev_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $fileDir = 'images/';
        $filePath = public_path($fileDir) . $fileName;

        Image::make($file)
            ->fit(100, 100, function ($img) {
                $img->upsize();
            })
            ->save($filePath, 80, 'jpg');

        return $fileDir . $fileName;
    }

    public static function remove(array $files)
    {
        foreach ($files as $file) {
            File::delete(public_path(str_replace('/', '\\', $file)));
        }
    }
}
