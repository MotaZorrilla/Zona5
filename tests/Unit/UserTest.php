<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Role;
use App\Models\Lodge;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_roles()
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'Admin']);

        $user->roles()->attach($role->id);

        $this->assertTrue($user->roles->contains($role->id));
        $this->assertEquals(1, $user->roles->count());
    }

    public function test_user_has_lodges()
    {
        $user = User::factory()->create();
        $lodge = Lodge::create([
            'name' => 'Test Lodge',
            'number' => 1,
            'orient' => 'Test Orient',
        ]);

        $user->lodges()->attach($lodge->id);

        $this->assertTrue($user->lodges->contains($lodge->id));
        $this->assertEquals(1, $user->lodges->count());
    }

    public function test_user_can_check_role()
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'Admin']);

        $user->roles()->attach($role->id);

        $this->assertTrue($user->roles->contains($role->id));
    }
}