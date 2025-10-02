<?php

namespace Tests\Feature\Admin;

use App\Models\Faq;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FaqControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $adminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed('RoleSeeder');
        $this->adminUser = User::factory()->create();
        $this->adminUser->roles()->attach(Role::where('name', 'Admin')->first());
    }

    public function test_admin_can_view_faqs_index()
    {
        $response = $this->actingAs($this->adminUser)->get(route('admin.faqs.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.faqs.index');
    }

    public function test_admin_can_create_a_faq()
    {
        $data = [
            'question' => 'Test Question',
            'answer' => 'Test Answer',
            'category' => 'General',
            'is_active' => true,
            'order' => 1,
        ];

        $response = $this->actingAs($this->adminUser)->post(route('admin.faqs.store'), $data);

        $response->assertRedirect(route('admin.faqs.index'));
        $this->assertDatabaseHas('faqs', ['question' => 'Test Question']);
    }

    public function test_admin_can_edit_a_faq()
    {
        $faq = Faq::factory()->create();

        $response = $this->actingAs($this->adminUser)->get(route('admin.faqs.edit', $faq));

        $response->assertStatus(200);
        $response->assertViewIs('admin.faqs.edit');
    }

    public function test_admin_can_update_a_faq()
    {
        $faq = Faq::factory()->create();

        $data = [
            'question' => 'Updated Question',
            'answer' => 'Updated Answer',
            'category' => 'General',
            'is_active' => true,
            'order' => 1,
        ];

        $response = $this->actingAs($this->adminUser)->put(route('admin.faqs.update', $faq), $data);

        $response->assertRedirect(route('admin.faqs.index'));
        $this->assertDatabaseHas('faqs', ['question' => 'Updated Question']);
    }

    public function test_admin_can_delete_a_faq()
    {
        $faq = Faq::factory()->create();

        $response = $this->actingAs($this->adminUser)->delete(route('admin.faqs.destroy', $faq));

        $response->assertRedirect(route('admin.faqs.index'));
        $this->assertDatabaseMissing('faqs', ['id' => $faq->id]);
    }

    public function test_admin_can_toggle_faq_status()
    {
        $faq = Faq::factory()->create(['is_active' => true]);

        $response = $this->actingAs($this->adminUser)->patch(route('admin.faqs.toggle', $faq));

        $response->assertRedirect(route('admin.faqs.index'));
        $this->assertDatabaseHas('faqs', ['id' => $faq->id, 'is_active' => false]);
    }

    public function test_non_admin_cannot_access_admin_faqs_routes()
    {
        $user = User::factory()->create();
        $faq = Faq::factory()->create();

        $routes = [
            'get' => [
                route('admin.faqs.index'),
                route('admin.faqs.create'),
                route('admin.faqs.edit', $faq),
            ],
            'post' => [route('admin.faqs.store')],
            'put' => [route('admin.faqs.update', $faq)],
            'delete' => [route('admin.faqs.destroy', $faq)],
            'patch' => [route('admin.faqs.toggle', $faq)],
        ];

        foreach ($routes as $method => $urls) {
            foreach ($urls as $url) {
                $response = $this->actingAs($user)->$method($url);
                // All admin routes should be protected by auth middleware
                $response->assertStatus(302);
            }
        }
    }
}