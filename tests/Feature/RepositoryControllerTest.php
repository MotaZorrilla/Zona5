<?php

namespace Tests\Feature;

use App\Models\Repository;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RepositoryControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $adminUser;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create an admin user
        $this->adminUser = User::factory()->create();
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $this->adminUser->roles()->attach($adminRole->id);
    }

    public function test_admin_can_view_repository()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/repository');

        $response->assertStatus(200);
    }

    public function test_admin_can_view_create_repository_form()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/repository/create');

        $response->assertStatus(200);
    }

    public function test_admin_can_create_repository_entry()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('test.pdf', 500, 'application/pdf');

        $response = $this->actingAs($this->adminUser)
            ->post('/admin/repository', [
                'title' => 'Test Document',
                'description' => 'Test description',
                'document' => $file,
                'category' => 'Ritual y Liturgia',
                'grade_level' => 'Todos',
                '_token' => csrf_token(),
            ]);

        $response->assertRedirect('/admin/repository');
        
        $this->assertDatabaseHas('repositories', [
            'title' => 'Test Document',
            'description' => 'Test description',
            'category' => 'Ritual y Liturgia',
            'grade_level' => 'Todos',
            'uploaded_by' => $this->adminUser->id,
        ]);

        Storage::disk('public')->assertExists('repository/' . $file->hashName());
    }

    public function test_admin_can_view_repository_entry()
    {
        $repository = Repository::create([
            'title' => 'Test Document',
            'description' => 'Test description',
            'file_path' => 'repository/test.pdf',
            'file_name' => 'test.pdf',
            'file_type' => 'pdf',
            'category' => 'Ritual y Liturgia',
            'grade_level' => 'Todos',
            'uploaded_by' => $this->adminUser->id,
            'file_size' => 1024,
        ]);

        $response = $this->actingAs($this->adminUser)
            ->get("/admin/repository/{$repository->id}");

        $response->assertStatus(200);
        $response->assertViewHas('repository');
    }

    public function test_admin_can_edit_repository_entry()
    {
        $repository = Repository::create([
            'title' => 'Old Title',
            'description' => 'Old description',
            'file_path' => 'repository/test.pdf',
            'file_name' => 'test.pdf',
            'file_type' => 'pdf',
            'category' => 'Ritual y Liturgia',
            'grade_level' => 'Todos',
            'uploaded_by' => $this->adminUser->id,
            'file_size' => 1024,
        ]);

        $response = $this->actingAs($this->adminUser)
            ->put("/admin/repository/{$repository->id}", [
                'title' => 'New Title',
                'description' => 'New description',
                'category' => 'Administración',
                'grade_level' => 'Aprendiz',
                '_token' => csrf_token(),
            ]);

        $response->assertRedirect('/admin/repository');
        
        $this->assertDatabaseHas('repositories', [
            'id' => $repository->id,
            'title' => 'New Title',
            'description' => 'New description',
            'category' => 'Administración',
            'grade_level' => 'Aprendiz',
        ]);
    }

    public function test_admin_can_delete_repository_entry()
    {
        $repository = Repository::create([
            'title' => 'Test Document',
            'description' => 'Test description',
            'file_path' => 'repository/test.pdf',
            'file_name' => 'test.pdf',
            'file_type' => 'pdf',
            'category' => 'Ritual y Liturgia',
            'grade_level' => 'Todos',
            'uploaded_by' => $this->adminUser->id,
            'file_size' => 1024,
        ]);

        $response = $this->actingAs($this->adminUser)
            ->delete("/admin/repository/{$repository->id}", [
                '_token' => csrf_token(),
            ]);

        $response->assertRedirect('/admin/repository');
        $this->assertDatabaseMissing('repositories', [
            'id' => $repository->id,
        ]);
    }
}