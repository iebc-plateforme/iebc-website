<?php

use App\Helpers\ImageHelper;

if (!function_exists('image_url')) {
    /**
     * Get the full URL for an image, with fallback support
     *
     * @param string|null $path
     * @param string|null $fallback
     * @return string
     */
    function image_url(?string $path, ?string $fallback = null): string
    {
        return ImageHelper::url($path, $fallback);
    }
}

if (!function_exists('store_image')) {
    /**
     * Store an uploaded image in public/uploads directory
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory
     * @return string
     */
    function store_image($file, string $directory): string
    {
        return ImageHelper::storePublic($file, $directory);
    }
}

if (!function_exists('delete_image')) {
    /**
     * Delete an image from public directory
     *
     * @param string|null $path
     * @return bool
     */
    function delete_image(?string $path): bool
    {
        return ImageHelper::deletePublic($path);
    }
}
