<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

trait FileUploadTrait
{
    /**
     * Store an uploaded file in the specified directory
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param string $disk
     * @return string|null
     */
    protected function storeFile(UploadedFile $file, string $directory, string $disk = 'public'): ?string
    {
        return $file->store($directory, $disk);
    }

    /**
     * Store an uploaded file with a custom name
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param string|null $customName
     * @param string $disk
     * @return string|null
     */
    protected function storeFileWithCustomName(UploadedFile $file, string $directory, ?string $customName = null, string $disk = 'public'): ?string
    {
        if (!$customName) {
            $customName = $file->getClientOriginalName();
        }

        return $file->storeAs($directory, $customName, $disk);
    }

    /**
     * Delete a file from storage
     *
     * @param string|null $filePath
     * @param string $disk
     * @return bool
     */
    protected function deleteFile(?string $filePath, string $disk = 'public'): bool
    {
        if (!$filePath) {
            return false;
        }

        return Storage::disk($disk)->delete($filePath);
    }

    /**
     * Get the public URL for a stored file
     *
     * @param string|null $filePath
     * @param string $disk
     * @return string|null
     */
    protected function getFileUrl(?string $filePath, string $disk = 'public'): ?string
    {
        if (!$filePath) {
            return null;
        }

        return Storage::disk($disk)->url($filePath);
    }

    /**
     * Get file information
     *
     * @param string|null $filePath
     * @param string $disk
     * @return array|null
     */
    protected function getFileInfo(?string $filePath, string $disk = 'public'): ?array
    {
        if (!$filePath) {
            return null;
        }

        $storage = Storage::disk($disk);
        if (!$storage->exists($filePath)) {
            return null;
        }

        return [
            'size' => (int)$storage->size($filePath),
            'type' => $storage->mimeType($filePath),
            'name' => basename($filePath),
            'path' => $filePath,
            'url' => $this->getFileUrl($filePath, $disk),
        ];
    }

    /**
     * Process a file upload with validation
     *
     * @param UploadedFile|null $file
     * @param string $directory
     * @param array $allowedMimes
     * @param int $maxSizeInKb
     * @param string $disk
     * @return string|null
     */
    protected function processFileUpload(
        ?UploadedFile $file, 
        string $directory, 
        array $allowedMimes = [],
        int $maxSizeInKb = 10240, // 10MB default
        string $disk = 'public'
    ): ?string
    {
        if (!$file) {
            return null;
        }

        // Validate file type if allowed mimes specified
        if (!empty($allowedMimes) && !in_array($file->getMimeType(), $allowedMimes)) {
            throw new \InvalidArgumentException('File type not allowed.');
        }

        // Validate file size
        if ($file->getSize() > ($maxSizeInKb * 1024)) {
            throw new \InvalidArgumentException("File size exceeds {$maxSizeInKb}KB limit.");
        }

        return $this->storeFile($file, $directory, $disk);
    }

    /**
     * Update a file, deleting the old one if it exists
     *
     * @param UploadedFile|null $newFile
     * @param string|null $oldFilePath
     * @param string $directory
     * @param array $allowedMimes
     * @param int $maxSizeInKb
     * @param string $disk
     * @return string|null
     */
    protected function updateFile(
        ?UploadedFile $newFile,
        ?string $oldFilePath,
        string $directory,
        array $allowedMimes = [],
        int $maxSizeInKb = 10240,
        string $disk = 'public'
    ): ?string
    {
        if (!$newFile) {
            return $oldFilePath; // No new file, return old path
        }

        // Delete old file if it exists
        $this->deleteFile($oldFilePath, $disk);

        // Process and store new file
        return $this->processFileUpload($newFile, $directory, $allowedMimes, $maxSizeInKb, $disk);
    }
}