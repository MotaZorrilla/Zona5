<?php

namespace Tests\Feature\Admin;

use App\Models\Lodge;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LodgeControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $adminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\RoleSeeder::class);
        $this->adminUser = User::factory()->create();
        $this->adminUser->roles()->attach(Role::where('name', 'Admin')->first());
    }

    public function test_admin_can_view_lodges_index()
    {
        $response = $this->actingAs($this->adminUser)->get(route('admin.lodges.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.lodges.index');
    }

    public function test_admin_can_create_a_lodge()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('lodge.jpg');

        $data = [
            'name' => 'Test Lodge',
            'number' => 123,
            'orient' => 'Test Orient',
            'address' => '123 Test Street',
            'foundation_date' => '2023-01-01',
            'image_url' => $file,
        ];

        $response = $this->actingAs($this->adminUser)->post(route('admin.lodges.store'), $data);

        $response->assertRedirect(route('admin.lodges.index'));
        $this->assertDatabaseHas('lodges', ['name' => 'Test Lodge']);
        Storage::disk('public')->assertExists('uploads/lodges/' . $file->hashName());
    }

    public function test_admin_can_edit_a_lodge()
    {
        $lodge = Lodge::factory()->create();

        $response = $this->actingAs($this->adminUser)->get(route('admin.lodges.edit', $lodge));

        $response->assertStatus(200);
        $response->assertViewIs('admin.lodges.edit');
    }

    public function test_admin_can_update_a_lodge()
    {
        $lodge = Lodge::factory()->create();

        $data = [
            'name' => 'Updated Lodge Name',
            'number' => 456,
            'orient' => 'Updated Orient',
            'address' => '456 Updated Street',
            'foundation_date' => '2023-01-02',
        ];

        $response = $this->actingAs($this->adminUser)->put(route('admin.lodges.update', $lodge), $data);

        $response->assertRedirect(route('admin.lodges.index'));
        $this->assertDatabaseHas('lodges', ['name' => 'Updated Lodge Name']);
    }

    public function test_admin_can_delete_a_lodge()
    {
        $lodge = Lodge::factory()->create();

        $response = $this->actingAs($this->adminUser)->delete(route('admin.lodges.destroy', $lodge));

        $response->assertRedirect(route('admin.lodges.index'));
        $this->assertDatabaseMissing('lodges', ['id' => $lodge->id]);
    }

    public function test_non_admin_cannot_access_admin_lodges_routes()
    {
        $user = User::factory()->create();
        $lodge = Lodge::factory()->create();

        $routes = [
            'get' => [
                route('admin.lodges.index'),
                route('admin.lodges.create'),
                route('admin.lodges.edit', $lodge),
            ],
            'post' => [route('admin.lodges.store')],
            'put' => [route('admin.lodges.update', $lodge)],
            'delete' => [route('admin.lodges.destroy', $lodge)],
        ];

        foreach ($routes as $method => $urls) {
            foreach ($urls as $url) {
                $response = $this->actingAs($user)->$method($url);
                $response->assertStatus(403);
            }
        }
    }
}
