<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{
    protected $userRepository;

    /**
     * Create a new service instance.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Create a new user with roles
     *
     * @param array $data
     * @return \App\Models\User
     */
    public function create(array $data)
    {
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'lodge_id' => $data['lodge_id'] ?? null,
        ];

        $user = $this->userRepository->create($userData);

        // Sync roles if provided
        if (isset($data['roles'])) {
            $user->roles()->sync($data['roles']);
        }

        return $user;
    }

    /**
     * Update an existing user with roles
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\User|null
     */
    public function update($id, array $data)
    {
        $user = $this->find($id);

        if (!$user) {
            return null;
        }

        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];

        if (isset($data['password']) && !empty($data['password'])) {
            $userData['password'] = Hash::make($data['password']);
        }

        $user->update($userData);

        // Sync roles if provided
        if (isset($data['roles'])) {
            $user->roles()->sync($data['roles']);
        }

        return $user;
    }

    /**
     * Assign a new affiliation to a user
     *
     * @param int $userId
     * @param int $lodgeId
     * @param int $positionId
     * @return bool
     */
    public function assignAffiliation($userId, $lodgeId, $positionId)
    {
        $user = $this->find($userId);

        if (!$user) {
            return false;
        }

        $user->lodges()->attach($lodgeId, [
            'position_id' => $positionId
        ]);

        return true;
    }

    /**
     * Get users by role
     *
     * @param int $roleId
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByRole($roleId, $relations = ['roles', 'lodges'])
    {
        return $this->userRepository->getByRole($roleId, $relations);
    }

    /**
     * Get users by lodge
     *
     * @param int $lodgeId
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByLodge($lodgeId, $relations = ['roles', 'lodges'])
    {
        return $this->userRepository->getByLodge($lodgeId, $relations);
    }
    
    /**
     * Find a user by ID
     *
     * @param int $id
     * @param array $relations
     * @return \App\Models\User|null
     */
    public function find($id, $relations = [])
    {
        return $this->userRepository->find($id, $relations);
    }
}