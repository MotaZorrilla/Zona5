<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProgressTrackerControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        // Create admin role
        $adminRole = Role::create(['name' => 'Admin']);

        // Create admin user
        $this->adminUser = User::factory()->create();
        $this->adminUser->roles()->attach($adminRole->id);
    }

    public function test_get_progress_requires_authentication()
    {
        $response = $this->get('/admin/progress-tracker/get-progress');

        $response->assertRedirect('/login');
    }

    public function test_get_progress_without_task_id()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/progress-tracker/get-progress');

        $response->assertStatus(400);
        $response->assertJson([
            'success' => false,
            'message' => 'ID de tarea requerido'
        ]);
    }

    public function test_get_progress_with_invalid_task_id()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/progress-tracker/get-progress?task_id=invalid_task_id');

        $response->assertStatus(404);
        $response->assertJson([
            'success' => false,
            'message' => 'Tarea no encontrada'
        ]);
    }

    public function test_get_detailed_logs_requires_authentication()
    {
        $response = $this->get('/admin/progress-tracker/detailed-logs');

        $response->assertRedirect('/login');
    }

    public function test_get_detailed_logs_without_task_id()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/progress-tracker/detailed-logs');

        $response->assertStatus(400);
        $response->assertJson([
            'success' => false,
            'message' => 'ID de tarea requerido'
        ]);
    }

    public function test_get_tracker_stats()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/progress-tracker/stats');

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);
        $response->assertJsonStructure([
            'success',
            'stats' => [
                'total_tracker_files',
                'total_size',
                'recent_trackers'
            ]
        ]);
    }

    public function test_export_progress_data_requires_authentication()
    {
        $response = $this->get('/admin/progress-tracker/export');

        $response->assertRedirect('/login');
    }

    public function test_export_progress_data_without_task_id()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/progress-tracker/export');

        $response->assertStatus(400);
        $response->assertJson([
            'success' => false,
            'message' => 'ID de tarea requerido'
        ]);
    }
}