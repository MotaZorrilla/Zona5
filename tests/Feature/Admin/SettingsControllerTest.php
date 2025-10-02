<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class SettingsControllerTest extends TestCase
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

    public function test_settings_index_accessible_to_admin()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/settings');

        $response->assertStatus(200);
        $response->assertViewIs('admin.settings');
    }

    public function test_settings_index_requires_authentication()
    {
        $response = $this->get('/admin/settings');

        $response->assertRedirect('/login');
    }

    public function test_update_general_settings()
    {
        $requestData = [
            'section' => 'general',
            'site_name' => 'Test Site Name',
            'site_description' => 'Test Site Description',
            'site_email' => 'test@example.com',
            'site_phone' => '+1234567890',
            'maintenance_mode' => true,
            'timezone' => 'America/New_York'
        ];

        $response = $this->actingAs($this->adminUser)
            ->post('/admin/settings', $requestData);

        $response->assertRedirect('/admin/settings');
        $response->assertSessionHas('success', 'Configuración general actualizada correctamente');

        $this->assertEquals('Test Site Name', Setting::get('site_name'));
        $this->assertEquals('Test Site Description', Setting::get('site_description'));
        $this->assertEquals('test@example.com', Setting::get('site_email'));
        $this->assertEquals('+1234567890', Setting::get('site_phone'));
        $this->assertTrue(Setting::get('maintenance_mode'));
        $this->assertEquals('America/New_York', Setting::get('timezone'));
    }

    public function test_update_contact_settings()
    {
        $requestData = [
            'section' => 'contact',
            'contact_email' => 'contact@test.com',
            'contact_phone' => '+987654321',
            'contact_address' => '123 Test St',
            'contact_hours' => '9AM-5PM'
        ];

        $response = $this->actingAs($this->adminUser)
            ->post('/admin/settings', $requestData);

        $response->assertRedirect('/admin/settings');
        $response->assertSessionHas('success', 'Configuración de contacto actualizada correctamente');

        $this->assertEquals('contact@test.com', Setting::get('contact_email'));
        $this->assertEquals('+987654321', Setting::get('contact_phone'));
        $this->assertEquals('123 Test St', Setting::get('contact_address'));
        $this->assertEquals('9AM-5PM', Setting::get('contact_hours'));
    }

    public function test_update_footer_settings()
    {
        $requestData = [
            'section' => 'footer',
            'footer_copyright' => '© 2023 Test Site. All rights reserved.',
            'footer_links' => [
                ['name' => 'About Us', 'url' => '/about'],
                ['name' => 'Contact', 'url' => '/contact']
            ]
        ];

        $response = $this->actingAs($this->adminUser)
            ->post('/admin/settings', $requestData);

        $response->assertRedirect('/admin/settings');
        $response->assertSessionHas('success', 'Configuración de pie de página actualizada correctamente');

        $this->assertEquals('© 2023 Test Site. All rights reserved.', Setting::get('footer_copyright'));
        $footerLinks = Setting::get('footer_links');
        $this->assertCount(2, $footerLinks);
        $this->assertEquals('About Us', $footerLinks[0]['name']);
        $this->assertEquals('/about', $footerLinks[0]['url']);
    }

    public function test_update_settings_with_invalid_section()
    {
        $requestData = [
            'section' => 'invalid_section',
        ];

        $response = $this->actingAs($this->adminUser)
            ->post('/admin/settings', $requestData);

        $response->assertRedirect('/admin/settings');
        $response->assertSessionHas('error', 'Sección no válida');
    }

    public function test_update_general_settings_validation()
    {
        $requestData = [
            'section' => 'general',
            'site_name' => '', // Required field
            'site_description' => 'Test Site Description',
            'site_email' => 'invalid-email', // Invalid email
            'timezone' => 'America/New_York'
        ];

        $response = $this->actingAs($this->adminUser)
            ->post('/admin/settings', $requestData);

        $response->assertSessionHasErrors([
            'site_name',
            'site_email'
        ]);
    }

    public function test_settings_initial_data()
    {
        // Set some initial settings
        Setting::set('site_name', 'Initial Site Name');
        Setting::set('contact_email', 'initial@test.com');
        Setting::set('footer_copyright', '© 2023 Initial Copyright');

        $response = $this->actingAs($this->adminUser)
            ->get('/admin/settings');

        $response->assertStatus(200);
        $response->assertViewHas('generalSettings');
        $response->assertViewHas('contactSettings');
        $response->assertViewHas('footerSettings');
    }
}