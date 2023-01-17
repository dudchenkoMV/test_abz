<?php

namespace App\Services\Contracts;

use Illuminate\Http\UploadedFile;

interface ImageServiceContract
{
    public static function uploadImage(UploadedFile|string $file);
    public static function uploadPreview(UploadedFile|string $file);
    public static function remove(array $files);
}
