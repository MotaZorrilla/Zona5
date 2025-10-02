<?php

namespace Tests\Unit;

use App\Models\ZoneDignitary;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ZoneDignitaryTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_zone_dignitary()
    {
        $dignitary = ZoneDignitary::create([
            'name' => 'Test Dignitary',
            'role' => 'Grand Master',
            'image_url' => '/images/test_dignitary.jpg',
            'bio' => 'Test biography',
        ]);

        $this->assertDatabaseHas('zone_dignitaries', [
            'name' => 'Test Dignitary',
            'role' => 'Grand Master',
        ]);
    }

    public function test_zone_dignitary_attributes()
    {
        $dignitary = ZoneDignitary::create([
            'name' => 'Test Dignitary',
            'role' => 'Grand Master',
            'image_url' => '/images/test_dignitary.jpg',
            'bio' => 'Test biography',
        ]);

        $this->assertEquals('Test Dignitary', $dignitary->name);
        $this->assertEquals('Grand Master', $dignitary->role);
        $this->assertEquals('/images/test_dignitary.jpg', $dignitary->image_url);
        $this->assertEquals('Test biography', $dignitary->bio);
    }
}