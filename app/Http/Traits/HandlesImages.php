<?php

namespace App\Http\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HandlesImages
{
    protected function handleImageUpload(UploadedFile $image, string $directory = 'images'): string
    {
        $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs($directory, $filename, 'public');
        
        return $path;
    }

    protected function handleMultipleImageUploads(array $images, string $directory = 'images'): array
    {
        $paths = [];
        
        foreach ($images as $image) {
            if ($image instanceof UploadedFile) {
                $paths[] = $this->handleImageUpload($image, $directory);
            }
        }
        
        return $paths;
    }

    protected function deleteImage(?string $imagePath): void
    {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }

    protected function deleteMultipleImages(?array $imagePaths): void
    {
        if (!$imagePaths) {
            return;
        }

        foreach ($imagePaths as $imagePath) {
            $this->deleteImage($imagePath);
        }
    }

    protected function getImageUrl(?string $imagePath): ?string
    {
        if (!$imagePath) {
            return null;
        }

        return Storage::disk('public')->url($imagePath);
    }
}