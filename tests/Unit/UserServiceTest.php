<?php

namespace Tests\Unit;

use App\Services\UserService;
use App\Repositories\UserRepository;
use App\Models\User;
use App\Models\Lodge;
use App\Models\Position;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Mockery;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    private $userRepository;
    private $userService;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->userRepository = Mockery::mock(UserRepository::class);
        $this->userService = new UserService($this->userRepository);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_create_user()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'lodge_id' => 1,
            'roles' => [1, 2]
        ];

        $user = User::factory()->make();
        $user->id = 1;
        $user->name = 'Test User';
        $user->email = 'test@example.com';
        
        $this->userRepository->shouldReceive('create')
            ->once()
            ->with([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => Hash::make('password123'),
                'lodge_id' => 1,
            ])
            ->andReturn($user);

        $result = $this->userService->create($userData);

        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals('Test User', $result->name);
        $this->assertEquals('test@example.com', $result->email);
    }

    public function test_update_user()
    {
        $userId = 1;
        $userData = [
            'name' => 'Updated User',
            'email' => 'updated@example.com',
            'password' => 'newpassword123',
            'roles' => [1]
        ];

        $user = User::factory()->create([
            'id' => $userId,
            'name' => 'Original User',
            'email' => 'original@example.com'
        ]);

        $this->userRepository->shouldReceive('find')
            ->once()
            ->with($userId, [])
            ->andReturn($user);

        $result = $this->userService->update($userId, $userData);

        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals('Updated User', $result->name);
        $this->assertEquals('updated@example.com', $result->email);
    }

    public function test_update_user_without_password()
    {
        $userId = 1;
        $userData = [
            'name' => 'Updated User',
            'email' => 'updated@example.com',
            // No password provided
            'roles' => [1]
        ];

        $user = User::factory()->create([
            'id' => $userId,
            'name' => 'Original User',
            'email' => 'original@example.com'
        ]);

        $this->userRepository->shouldReceive('find')
            ->once()
            ->with($userId, [])
            ->andReturn($user);

        $result = $this->userService->update($userId, $userData);

        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals('Updated User', $result->name);
        $this->assertEquals('updated@example.com', $result->email);
    }

    public function test_assign_affiliation()
    {
        $user = User::factory()->create(['id' => 1]);
        $lodge = Lodge::factory()->create(['id' => 1]);
        $position = Position::factory()->create(['id' => 1]);

        $this->userRepository->shouldReceive('find')
            ->once()
            ->with(1)
            ->andReturn($user);

        $result = $this->userService->assignAffiliation(1, 1, 1);

        $this->assertTrue($result);
    }

    public function test_assign_affiliation_user_not_found()
    {
        $this->userRepository->shouldReceive('find')
            ->once()
            ->with(999)
            ->andReturn(null);

        $result = $this->userService->assignAffiliation(999, 1, 1);

        $this->assertFalse($result);
    }

    public function test_get_by_role()
    {
        $users = collect([User::factory()->make()]);
        
        $this->userRepository->shouldReceive('getByRole')
            ->once()
            ->with(1, ['roles', 'lodges'])
            ->andReturn($users);

        $result = $this->userService->getByRole(1);

        $this->assertCount(1, $result);
    }

    public function test_get_by_lodge()
    {
        $users = collect([User::factory()->make()]);
        
        $this->userRepository->shouldReceive('getByLodge')
            ->once()
            ->with(1, ['roles', 'lodges'])
            ->andReturn($users);

        $result = $this->userService->getByLodge(1);

        $this->assertCount(1, $result);
    }

    public function test_find_user()
    {
        $user = User::factory()->create(['id' => 1]);
        
        $this->userRepository->shouldReceive('find')
            ->once()
            ->with(1, [])
            ->andReturn($user);

        $result = $this->userService->find(1);

        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals(1, $result->id);
    }
}