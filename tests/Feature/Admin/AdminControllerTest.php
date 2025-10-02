<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $adminUser;
    protected $regularUser;

    protected function setUp(): void
    {
        parent::setUp();

        // Create roles
        $adminRole = Role::create(['name' => 'Admin']);
        $userRole = Role::create(['name' => 'User']);

        // Create admin user
        $this->adminUser = User::factory()->create();
        $this->adminUser->roles()->attach($adminRole->id);

        // Create regular user
        $this->regularUser = User::factory()->create();
        $this->regularUser->roles()->attach($userRole->id);
    }

    public function test_admin_dashboard_accessible_to_admin()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard');
        $response->assertSee('Panel de Administración');
    }

    public function test_admin_dashboard_redirects_non_admin()
    {
        $response = $this->actingAs($this->regularUser)
            ->get('/admin/dashboard');

        // This will likely redirect or return a 403 depending on middleware
        $response->assertStatus(302); // Redirect
    }

    public function test_admin_dashboard_requires_authentication()
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_dashboard_statistics()
    {
        // Create some test data to verify dashboard statistics
        User::factory()->count(5)->create();
        
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertViewHas('memberCount', 5);
    }
}