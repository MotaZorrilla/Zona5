<?php

namespace Tests\Unit;

use App\Models\Repository;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_repository_can_be_created()
    {
        $user = User::factory()->create();
        
        $repository = Repository::create([
            'title' => 'Test Document',
            'description' => 'Test description',
            'file_path' => 'repository/test.pdf',
            'file_name' => 'test.pdf',
            'file_type' => 'pdf',
            'category' => 'Ritual y Liturgia',
            'grade_level' => 'Todos',
            'uploaded_by' => $user->id,
            'file_size' => 1024,
        ]);

        $this->assertDatabaseHas('repositories', [
            'title' => 'Test Document',
            'description' => 'Test description',
            'file_path' => 'repository/test.pdf',
            'file_name' => 'test.pdf',
            'file_type' => 'pdf',
            'category' => 'Ritual y Liturgia',
            'grade_level' => 'Todos',
            'uploaded_by' => $user->id,
            'file_size' => 1024,
        ]);
    }

    public function test_repository_belongs_to_uploader()
    {
        $user = User::factory()->create();
        
        $repository = Repository::create([
            'title' => 'Test Document',
            'description' => 'Test description',
            'file_path' => 'repository/test.pdf',
            'file_name' => 'test.pdf',
            'file_type' => 'pdf',
            'category' => 'Ritual y Liturgia',
            'grade_level' => 'Todos',
            'uploaded_by' => $user->id,
            'file_size' => 1024,
        ]);

        $this->assertEquals($user->id, $repository->uploader->id);
    }
}