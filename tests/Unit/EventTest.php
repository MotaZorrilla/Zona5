<?php

namespace Tests\Unit;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    public function test_event_has_fillable_attributes()
    {
        $event = new Event();
        $fillable = [
            'title',
            'description',
            'start_time',
            'end_time',
            'location',
            'type',
            'is_public',
            'created_by',
        ];

        $this->assertEquals($fillable, $event->getFillable());
    }

    public function test_event_belongs_to_a_creator()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create(['created_by' => $user->id]);

        $this->assertInstanceOf(User::class, $event->creator);
        $this->assertEquals($user->id, $event->creator->id);
    }
}
