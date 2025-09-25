<?php

namespace Tests\Unit;

use App\Traits\FileUploadTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileUploadTraitTest extends TestCase
{
    use FileUploadTrait;

    public function test_store_file()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('test.txt', 100);

        $path = $this->storeFile($file, 'test', 'public');

        Storage::disk('public')->assertExists($path);
        $this->assertStringStartsWith('test/', $path);
    }

    public function test_store_file_with_custom_name()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('original.txt', 100);

        $path = $this->storeFileWithCustomName($file, 'test', 'custom.txt', 'public');

        Storage::disk('public')->assertExists($path);
        $this->assertEquals('test/custom.txt', $path);
    }

    public function test_delete_file()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('test.txt', 100);
        $path = $this->storeFile($file, 'test', 'public');

        $result = $this->deleteFile($path, 'public');

        $this->assertTrue($result);
        Storage::disk('public')->assertMissing($path);
    }

    public function test_delete_file_with_null_path()
    {
        $result = $this->deleteFile(null, 'public');

        $this->assertFalse($result);
    }

    public function test_get_file_url()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('test.txt', 100);
        $path = $this->storeFile($file, 'test', 'public');

        $url = $this->getFileUrl($path, 'public');

        $this->assertStringContainsString($path, $url);
        $this->assertIsString($url);
    }

    public function test_get_file_info()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('test.txt', 100);
        $path = $this->storeFile($file, 'test', 'public');

        $info = $this->getFileInfo($path, 'public');

        $this->assertIsArray($info);
        $this->assertArrayHasKey('size', $info);
        $this->assertArrayHasKey('type', $info);
        $this->assertArrayHasKey('name', $info);
        $this->assertArrayHasKey('path', $info);
        $this->assertArrayHasKey('url', $info);
        $this->assertEquals($path, $info['path']);
        $this->assertNotNull($info['name']);
        $this->assertIsInt($info['size']);
    }

    public function test_get_file_info_with_nonexistent_file()
    {
        $info = $this->getFileInfo('nonexistent/file.txt', 'public');

        $this->assertNull($info);
    }

    public function test_update_file()
    {
        Storage::fake('public');

        // Create and store original file
        $originalFile = UploadedFile::fake()->create('original.txt', 100);
        $originalPath = $this->storeFile($originalFile, 'test', 'public');

        // Create new file to update with
        $newFile = UploadedFile::fake()->create('new.txt', 200);

        $updatedPath = $this->updateFile($newFile, $originalPath, 'test', [], 1024, 'public');

        // Original file should be deleted
        Storage::disk('public')->assertMissing($originalPath);
        
        // New file should exist
        Storage::disk('public')->assertExists($updatedPath);
        
        // Return path should be different from original path
        $this->assertNotEquals($originalPath, $updatedPath);
    }
}