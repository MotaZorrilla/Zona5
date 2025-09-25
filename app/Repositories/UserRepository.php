<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends AbstractRepository
{
    /**
     * Create a new repository instance.
     *
     * @param \App\Models\User $user
     * @return void
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
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
        $query = $this->model->newQuery();

        if (!empty($relations)) {
            $query->with($relations);
        }

        return $query->whereHas('roles', function($q) use ($roleId) {
            $q->where('id', $roleId);
        })->get();
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
        $query = $this->model->newQuery();

        if (!empty($relations)) {
            $query->with($relations);
        }

        return $query->whereHas('lodges', function($q) use ($lodgeId) {
            $q->where('id', $lodgeId);
        })->get();
    }
}