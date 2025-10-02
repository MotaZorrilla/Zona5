<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContentManagerControllerTest extends TestCase
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

    public function test_content_manager_accessible_to_admin()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/content-manager');

        $response->assertStatus(200);
        $response->assertViewIs('admin.content-manager');
    }

    public function test_content_manager_section_accessible()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/content-manager/general');

        $response->assertStatus(200);
        $response->assertViewIs('admin.content-manager');
        $response->assertViewHas('currentSection', 'general');
    }

    public function test_content_manager_invalid_section_returns_404()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/content-manager/invalid-section');

        $response->assertStatus(404);
    }

    public function test_update_contact_settings()
    {
        $request_data = [
            'contact_page_title' => 'Contact Us',
            'contact_page_subtitle' => 'Get in touch with us',
            'contact_banner_image' => 'https://example.com/banner.jpg',
            'contact_email' => 'contact@example.com',
            'contact_phone' => '+1234567890',
            'contact_address' => '123 Test Street',
            'contact_hours' => '9 AM - 5 PM',
            'contact_show_form' => true,
            'contact_show_map' => false,
            'contact_show_info' => true,
            'contact_form_enabled' => true,
        ];

        $response = $this->actingAs($this->adminUser)
            ->post('/admin/content-manager/contact/update', $request_data);

        $response->assertRedirect('/admin/content-manager/contact');
        $response->assertSessionHas('success', 'Configuración de contacto actualizada correctamente');

        // Verify settings were saved
        $this->assertEquals('Contact Us', Setting::get('contact_page_title'));
        $this->assertEquals('contact@example.com', Setting::get('contact_email'));
        $this->assertEquals('+1234567890', Setting::get('contact_phone'));
    }

    public function test_update_contact_settings_validation()
    {
        $request_data = [
            'contact_page_title' => '', // Required field
            'contact_page_subtitle' => 'Get in touch with us',
            'contact_banner_image' => 'invalid-url',
            'contact_email' => 'invalid-email',
        ];

        $response = $this->actingAs($this->adminUser)
            ->post('/admin/content-manager/contact/update', $request_data);

        $response->assertSessionHasErrors([
            'contact_page_title', 
            'contact_banner_image', 
            'contact_email'
        ]);
    }
}