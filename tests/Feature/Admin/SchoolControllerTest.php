<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SchoolControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $adminUser;
    protected $regularUser;
    protected $superAdminUser;

    protected function setUp(): void
    {
        parent::setUp();

        // Create roles
        $adminRole = Role::create(['name' => 'Admin']);
        $superAdminRole = Role::create(['name' => 'SuperAdmin']);
        $userRole = Role::create(['name' => 'User']);

        // Create users
        $this->adminUser = User::factory()->create(['name' => 'Admin User']);
        $this->adminUser->roles()->attach($adminRole->id);

        $this->superAdminUser = User::factory()->create(['name' => 'Super Admin User']);
        $this->superAdminUser->roles()->attach($superAdminRole->id);

        $this->regularUser = User::factory()->create(['name' => 'Regular User']);
        $this->regularUser->roles()->attach($userRole->id);
    }

    public function test_school_index_accessible_to_admin()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/school');

        $response->assertStatus(200);
        $response->assertViewIs('admin.school.index');
    }

    public function test_school_index_accessible_to_super_admin()
    {
        $response = $this->actingAs($this->superAdminUser)
            ->get('/admin/school');

        $response->assertStatus(200);
        $response->assertViewIs('admin.school.index');
    }

    public function test_school_index_forbidden_to_regular_user()
    {
        $response = $this->actingAs($this->regularUser)
            ->get('/admin/school');

        $response->assertStatus(403);
    }

    public function test_school_index_requires_authentication()
    {
        $response = $this->get('/admin/school');

        $response->assertRedirect('/login');
    }

    public function test_school_create_accessible_to_admin()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/school/create');

        $response->assertStatus(200);
        $response->assertViewIs('admin.school.create');
    }

    public function test_school_create_accessible_to_super_admin()
    {
        $response = $this->actingAs($this->superAdminUser)
            ->get('/admin/school/create');

        $response->assertStatus(200);
        $response->assertViewIs('admin.school.create');
    }

    public function test_school_create_forbidden_to_regular_user()
    {
        $response = $this->actingAs($this->regularUser)
            ->get('/admin/school/create');

        $response->assertStatus(403);
    }

    public function test_school_create_requires_authentication()
    {
        $response = $this->get('/admin/school/create');

        $response->assertRedirect('/login');
    }
}