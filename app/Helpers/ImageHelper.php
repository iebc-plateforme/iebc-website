<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageHelper
{
    /**
     * Store an uploaded file directly in the public directory
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory The subdirectory within public/uploads (e.g., 'partners', 'teams')
     * @return string The relative path to the stored file
     */
    public static function storePublic($file, string $directory): string
    {
        // Ensure the directory exists
        $targetPath = public_path("uploads/{$directory}");
        if (!file_exists($targetPath)) {
            mkdir($targetPath, 0755, true);
        }

        // Generate a unique filename
        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();

        // Move the file to public/uploads/{directory}
        $file->move($targetPath, $filename);

        // Return the relative path (without 'public/')
        return "uploads/{$directory}/{$filename}";
    }

    /**
     * Delete a file from the public directory
     *
     * @param string|null $path The relative path to the file
     * @return bool
     */
    public static function deletePublic(?string $path): bool
    {
        if (!$path) {
            return false;
        }

        $fullPath = public_path($path);

        if (file_exists($fullPath) && is_file($fullPath)) {
            return unlink($fullPath);
        }

        return false;
    }

    /**
     * Get the full URL for an image
     *
     * @param string|null $path The relative path to the image
     * @param string|null $fallback Fallback image path if main image doesn't exist
     * @return string
     */
    public static function url(?string $path, ?string $fallback = null): string
    {
        // If no path provided, return fallback or empty
        if (!$path) {
            return $fallback ? asset($fallback) : asset('img/placeholder.png');
        }

        // If path starts with 'storage/', it's an old symlink-based path
        // Try to handle both old and new formats
        if (Str::startsWith($path, 'storage/')) {
            // Check if file exists in old location
            $oldPath = storage_path('app/public/' . Str::after($path, 'storage/'));
            if (file_exists($oldPath)) {
                return asset($path);
            }

            // Try new location
            $newPath = 'uploads/' . Str::after($path, 'storage/');
            if (file_exists(public_path($newPath))) {
                return asset($newPath);
            }

            return $fallback ? asset($fallback) : asset('img/placeholder.png');
        }

        // For new format (uploads/...)
        if (file_exists(public_path($path))) {
            return asset($path);
        }

        return $fallback ? asset($fallback) : asset('img/placeholder.png');
    }

    /**
     * Check if a file exists
     *
     * @param string|null $path
     * @return bool
     */
    public static function exists(?string $path): bool
    {
        if (!$path) {
            return false;
        }

        // Handle both old and new formats
        if (Str::startsWith($path, 'storage/')) {
            $oldPath = storage_path('app/public/' . Str::after($path, 'storage/'));
            if (file_exists($oldPath)) {
                return true;
            }
            $newPath = 'uploads/' . Str::after($path, 'storage/');
            return file_exists(public_path($newPath));
        }

        return file_exists(public_path($path));
    }

    /**
     * Migrate an image from storage/app/public to public/uploads
     * This is useful for transitioning existing images
     *
     * @param string $oldPath Path like 'partners/xyz.jpg' (stored in storage/app/public/)
     * @param string $directory Target directory in public/uploads
     * @return string|null New path or null if migration failed
     */
    public static function migrateToPublic(string $oldPath, string $directory): ?string
    {
        $sourcePath = storage_path('app/public/' . $oldPath);

        if (!file_exists($sourcePath)) {
            return null;
        }

        // Ensure target directory exists
        $targetDir = public_path("uploads/{$directory}");
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        // Get filename from old path
        $filename = basename($oldPath);
        $targetPath = $targetDir . '/' . $filename;

        // Copy file to new location
        if (copy($sourcePath, $targetPath)) {
            // Delete old file
            @unlink($sourcePath);
            return "uploads/{$directory}/{$filename}";
        }

        return null;
    }
}
