<?php

namespace Tests\Unit;

use App\Repositories\UserRepository;
use App\Models\User;
use App\Models\Role;
use App\Models\Lodge;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private $userRepository;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->userRepository = new UserRepository(new User());
    }

    public function test_get_by_role()
    {
        // Create a role
        $role = Role::create(['name' => 'Admin']);
        
        // Create users
        $user1 = User::factory()->create(['name' => 'User 1']);
        $user2 = User::factory()->create(['name' => 'User 2']);
        
        // Attach role to user1 only
        $user1->roles()->attach($role->id);

        $usersWithRole = $this->userRepository->getByRole($role->id);

        $this->assertCount(1, $usersWithRole);
        $this->assertEquals('User 1', $usersWithRole->first()->name);
    }

    public function test_get_by_lodge()
    {
        // Create a lodge
        $lodge = Lodge::create([
            'name' => 'Test Lodge',
            'number' => 1,
            'orient' => 'Test Orient'
        ]);
        
        // Create users
        $user1 = User::factory()->create(['name' => 'User 1']);
        $user2 = User::factory()->create(['name' => 'User 2']);
        
        // Attach user1 to lodge
        $user1->lodges()->attach($lodge->id);

        $usersWithLodge = $this->userRepository->getByLodge($lodge->id);

        $this->assertCount(1, $usersWithLodge);
        $this->assertEquals('User 1', $usersWithLodge->first()->name);
    }

    public function test_repository_inheritance()
    {
        $this->assertInstanceOf(\App\Repositories\AbstractRepository::class, $this->userRepository);
    }

    public function test_find_method_from_parent()
    {
        $user = User::factory()->create([
            'name' => 'Test User'
        ]);

        $foundUser = $this->userRepository->find($user->id);

        $this->assertNotNull($foundUser);
        $this->assertEquals('Test User', $foundUser->name);
    }

    public function test_all_method_from_parent()
    {
        User::factory()->count(3)->create();

        $allUsers = $this->userRepository->all();

        $this->assertCount(3, $allUsers);
    }
}