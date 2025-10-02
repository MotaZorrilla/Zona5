<?php

namespace Tests\Feature\Admin;

use App\Models\Forum;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ForumControllerTest extends TestCase
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

    public function test_admin_can_view_forums_index()
    {
        $response = $this->actingAs($this->adminUser)->get(route('admin.forums.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.forums.index');
    }

    public function test_admin_can_create_a_forum()
    {
        $data = [
            'title' => 'Test Forum',
            'description' => 'Test Description',
            'category' => 'General',
            'is_active' => true,
            'is_pinned' => false,
            'order' => 1,
        ];

        $response = $this->actingAs($this->adminUser)->post(route('admin.forums.store'), $data);

        $response->assertRedirect(route('admin.forums.index'));
        $this->assertDatabaseHas('forums', ['title' => 'Test Forum']);
    }

    public function test_admin_can_view_a_forum()
    {
        $forum = Forum::factory()->create();

        $response = $this->actingAs($this->adminUser)->get(route('admin.forums.show', $forum));

        $response->assertStatus(200);
        $response->assertViewIs('admin.forums.show');
    }

    public function test_admin_can_edit_a_forum()
    {
        $forum = Forum::factory()->create();

        $response = $this->actingAs($this->adminUser)->get(route('admin.forums.edit', $forum));

        $response->assertStatus(200);
        $response->assertViewIs('admin.forums.edit');
    }

    public function test_admin_can_update_a_forum()
    {
        $forum = Forum::factory()->create();

        $data = [
            'title' => 'Updated Forum',
            'description' => 'Updated Description',
            'category' => 'General',
            'is_active' => true,
            'is_pinned' => false,
            'order' => 1,
        ];

        $response = $this->actingAs($this->adminUser)->put(route('admin.forums.update', $forum), $data);

        $response->assertRedirect(route('admin.forums.index'));
        $this->assertDatabaseHas('forums', ['title' => 'Updated Forum']);
    }

    public function test_admin_can_delete_a_forum()
    {
        $forum = Forum::factory()->create();

        $response = $this->actingAs($this->adminUser)->delete(route('admin.forums.destroy', $forum));

        $response->assertRedirect(route('admin.forums.index'));
        $this->assertDatabaseMissing('forums', ['id' => $forum->id]);
    }

    public function test_admin_can_toggle_forum_status()
    {
        $forum = Forum::factory()->create(['is_active' => true]);

        $response = $this->actingAs($this->adminUser)->patch(route('admin.forums.toggle', $forum));

        $response->assertRedirect(route('admin.forums.index'));
        $this->assertDatabaseHas('forums', ['id' => $forum->id, 'is_active' => false]);
    }

    public function test_non_admin_cannot_access_admin_forums_routes()
    {
        $user = User::factory()->create();
        $forum = Forum::factory()->create();

        $routes = [
            'get' => [
                route('admin.forums.index'),
                route('admin.forums.create'),
                route('admin.forums.show', $forum),
                route('admin.forums.edit', $forum),
            ],
            'post' => [route('admin.forums.store')],
            'put' => [route('admin.forums.update', $forum)],
            'delete' => [route('admin.forums.destroy', $forum)],
            'patch' => [route('admin.forums.toggle', $forum)],
        ];

        foreach ($routes as $method => $urls) {
            foreach ($urls as $url) {
                $response = $this->actingAs($user)->$method($url);
                $response->assertStatus(302);
            }
        }
    }
}
