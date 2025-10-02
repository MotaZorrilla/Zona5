<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use App\Models\ZoneDignitary;
use App\Models\Position;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ZoneDignitaryControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $adminUser;
    protected $superAdminUser;
    protected $regularUser;
    protected $zoneDignitary;

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

        // Create a position for testing
        Position::create(['name' => 'Venerable Maestro']);

        // Create a zone dignitary for testing
        $this->zoneDignitary = ZoneDignitary::factory()->create([
            'name' => 'Test Dignitary',
            'role' => 'Grand Master'
        ]);
    }

    public function test_index_accessible_to_admin()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/zone-dignitaries');

        $response->assertStatus(200);
        $response->assertViewIs('admin.dignitaries');
    }

    public function test_index_accessible_to_super_admin()
    {
        $response = $this->actingAs($this->superAdminUser)
            ->get('/admin/zone-dignitaries');

        $response->assertStatus(200);
        $response->assertViewIs('admin.dignitaries');
    }

    public function test_index_forbidden_to_regular_user()
    {
        $response = $this->actingAs($this->regularUser)
            ->get('/admin/zone-dignitaries');

        $response->assertStatus(403);
    }

    public function test_index_requires_authentication()
    {
        $response = $this->get('/admin/zone-dignitaries');

        $response->assertRedirect('/login');
    }

    public function test_index_with_search()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/zone-dignitaries', ['search' => 'Test']);

        $response->assertStatus(200);
        $response->assertViewIs('admin.dignitaries');
    }

    public function test_create_form_accessible_to_admin()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/zone-dignitaries/create');

        $response->assertStatus(200);
        $response->assertViewIs('admin.zone-dignitaries.create');
    }

    public function test_create_form_forbidden_to_regular_user()
    {
        $response = $this->actingAs($this->regularUser)
            ->get('/admin/zone-dignitaries/create');

        $response->assertStatus(403);
    }

    public function test_store_zone_dignitary()
    {
        $requestData = [
            'name' => 'New Zone Dignitary',
            'role' => 'Grand Master',
            'image_url' => 'https://example.com/image.jpg',
            'bio' => 'Test biography for the dignitary'
        ];

        $response = $this->actingAs($this->adminUser)
            ->post('/admin/zone-dignitaries', $requestData);

        $response->assertRedirect('/admin/zone-dignitaries');
        $response->assertSessionHas('success', 'Dignatario creado exitosamente.');

        $this->assertDatabaseHas('zone_dignitaries', [
            'name' => 'New Zone Dignitary',
            'role' => 'Grand Master'
        ]);
    }

    public function test_store_zone_dignitary_validation()
    {
        $requestData = [
            'name' => '', // Required field
            'role' => '', // Required field
            'image_url' => 'invalid-url' // Invalid URL
        ];

        $response = $this->actingAs($this->adminUser)
            ->post('/admin/zone-dignitaries', $requestData);

        $response->assertSessionHasErrors([
            'name',
            'role',
            'image_url'
        ]);
    }

    public function test_edit_form_accessible_to_admin()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/zone-dignitaries/' . $this->zoneDignitary->id . '/edit');

        $response->assertStatus(200);
        $response->assertViewIs('admin.zone-dignitaries.edit');
        $response->assertViewHas('zoneDignitary');
    }

    public function test_edit_form_forbidden_to_regular_user()
    {
        $response = $this->actingAs($this->regularUser)
            ->get('/admin/zone-dignitaries/' . $this->zoneDignitary->id . '/edit');

        $response->assertStatus(403);
    }

    public function test_update_zone_dignitary()
    {
        $requestData = [
            'name' => 'Updated Zone Dignitary',
            'role' => 'Deputy Grand Master',
            'image_url' => 'https://example.com/updated-image.jpg',
            'bio' => 'Updated biography'
        ];

        $response = $this->actingAs($this->adminUser)
            ->put('/admin/zone-dignitaries/' . $this->zoneDignitary->id, $requestData);

        $response->assertRedirect('/admin/zone-dignitaries');
        $response->assertSessionHas('success', 'Dignatario actualizado exitosamente.');

        $this->assertDatabaseHas('zone_dignitaries', [
            'id' => $this->zoneDignitary->id,
            'name' => 'Updated Zone Dignitary',
            'role' => 'Deputy Grand Master'
        ]);
    }

    public function test_update_zone_dignitary_validation()
    {
        $requestData = [
            'name' => '', // Required field
            'role' => '' // Required field
        ];

        $response = $this->actingAs($this->adminUser)
            ->put('/admin/zone-dignitaries/' . $this->zoneDignitary->id, $requestData);

        $response->assertSessionHasErrors([
            'name',
            'role'
        ]);
    }

    public function test_delete_zone_dignitary()
    {
        $zoneDignitary = ZoneDignitary::factory()->create([
            'name' => 'To Be Deleted',
            'role' => 'Officer'
        ]);

        $response = $this->actingAs($this->adminUser)
            ->delete('/admin/zone-dignitaries/' . $zoneDignitary->id);

        $response->assertRedirect('/admin/zone-dignitaries');
        $response->assertSessionHas('success', 'Dignatario eliminado exitosamente.');

        $this->assertDatabaseMissing('zone_dignitaries', [
            'id' => $zoneDignitary->id
        ]);
    }

    public function test_delete_zone_dignitary_forbidden_to_regular_user()
    {
        $response = $this->actingAs($this->regularUser)
            ->delete('/admin/zone-dignitaries/' . $this->zoneDignitary->id);

        $response->assertStatus(403);
    }
}