<?php

namespace Tests\Unit;

use App\Models\Lodge;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LodgeTest extends TestCase
{
    use RefreshDatabase;

    public function test_lodge_can_be_created()
    {
        $lodge = Lodge::create([
            'name' => 'Test Lodge',
            'number' => 1,
            'orient' => 'Test Orient',
            'history' => 'Test history',
            'address' => 'Test address',
        ]);

        $this->assertDatabaseHas('lodges', [
            'name' => 'Test Lodge',
            'number' => 1,
            'orient' => 'Test Orient',
            'history' => 'Test history',
            'address' => 'Test address',
        ]);
    }

    public function test_lodge_has_users()
    {
        $lodge = Lodge::create([
            'name' => 'Test Lodge',
            'number' => 1,
            'orient' => 'Test Orient',
            'history' => 'Test history',
            'address' => 'Test address',
        ]);

        $user = User::factory()->create();
        $lodge->users()->attach($user->id);

        $this->assertTrue($lodge->users->contains($user->id));
    }

    public function test_lodge_has_users_count()
    {
        $lodge = Lodge::create([
            'name' => 'Test Lodge',
            'number' => 1,
            'orient' => 'Test Orient',
            'history' => 'Test history',
            'address' => 'Test address',
        ]);

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        
        $lodge->users()->attach($user1->id);
        $lodge->users()->attach($user2->id);

        $lodgeWithCount = Lodge::withCount('users')->find($lodge->id);
        $this->assertEquals(2, $lodgeWithCount->users_count);
    }
}