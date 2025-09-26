<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_event()
    {
        $user = User::factory()->create();
        
        $this->actingAs($user);
        
        $response = $this->followingRedirects()->post(route('admin.events.store'), [
            'title' => 'Test Event',
            'description' => 'This is a test event',
            'start_time' => '2025-09-30 10:00:00',
            'end_time' => '2025-09-30 12:00:00',
            'location' => 'Test Location',
            'type' => 'event',
            'is_public' => true,
        ]);
        
        $response->assertStatus(200);
        $this->assertDatabaseHas('events', [
            'title' => 'Test Event',
            'description' => 'This is a test event',
        ]);
    }
    
    /** @test */
    public function it_can_update_an_event()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create();
        
        $this->actingAs($user);
        
        $response = $this->followingRedirects()->put(route('admin.events.update', $event), [
            'title' => 'Updated Event',
            'description' => 'This is an updated event',
            'start_time' => '2025-10-01 14:00:00',
            'end_time' => '2025-10-01 16:00:00',
            'location' => 'Updated Location',
            'type' => 'conference',
            'is_public' => false,
        ]);
        
        $response->assertStatus(200);
        $this->assertDatabaseHas('events', [
            'title' => 'Updated Event',
            'description' => 'This is an updated event',
        ]);
    }
    
    /** @test */
    public function it_can_delete_an_event()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create();
        
        $this->actingAs($user);
        
        $response = $this->followingRedirects()->delete(route('admin.events.destroy', $event));
        
        $response->assertStatus(200);
        $this->assertDatabaseMissing('events', [
            'id' => $event->id,
        ]);
    }
}