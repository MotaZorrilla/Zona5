<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use App\Models\Lodge;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportControllerTest extends TestCase
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

    public function test_report_index_accessible_to_admin()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/reports');

        $response->assertStatus(200);
        $response->assertViewIs('admin.reports.index');
    }

    public function test_report_index_requires_authentication()
    {
        $response = $this->get('/admin/reports');

        $response->assertRedirect('/login');
    }

    public function test_generate_report()
    {
        $requestData = [
            'period' => '1_month',
            'sections' => ['kpis', 'members']
        ];

        $response = $this->actingAs($this->adminUser)
            ->post('/admin/reports/generate', $requestData);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        $response->assertJsonStructure([
            'success',
            'task_id',
            'message'
        ]);
    }

    public function test_generate_report_validation_error()
    {
        $requestData = [
            'period' => 'invalid_period', // Invalid period
            'sections' => [] // Empty sections array
        ];

        $response = $this->actingAs($this->adminUser)
            ->post('/admin/reports/generate', $requestData);

        $response->assertStatus(422);
        $response->assertJson(['success' => false]);
    }

    public function test_generate_report_with_custom_dates()
    {
        $requestData = [
            'period' => 'custom',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31',
            'sections' => ['kpis', 'finance']
        ];

        $response = $this->actingAs($this->adminUser)
            ->post('/admin/reports/generate', $requestData);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
    }

    public function test_get_task_status()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/reports/task-status?task_id=nonexistent_task');

        $response->assertStatus(404);
        $response->assertJson(['success' => false, 'message' => 'Tarea no encontrada']);
    }

    public function test_get_task_status_without_task_id()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/reports/task-status');

        $response->assertStatus(400);
        $response->assertJson(['success' => false, 'message' => 'Task ID requerido']);
    }

    public function test_get_task_logs_without_task_id()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/reports/task-logs');

        $response->assertStatus(400);
        $response->assertJson(['success' => false, 'message' => 'Task ID requerido']);
    }

    public function test_download_nonexistent_report()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/reports/download/nonexistent_report.pdf');

        $response->assertStatus(404);
    }

    public function test_delete_nonexistent_report()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/reports/delete/nonexistent_report.pdf');

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Reporte no encontrado');
    }

    public function test_generate_report_with_lodge_filter()
    {
        $lodge = Lodge::factory()->create();

        $requestData = [
            'period' => '1_month',
            'lodge_filter' => $lodge->id,
            'sections' => ['kpis', 'members']
        ];

        $response = $this->actingAs($this->adminUser)
            ->post('/admin/reports/generate', $requestData);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
    }
}