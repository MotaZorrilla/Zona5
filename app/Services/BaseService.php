<?php

namespace App\Services;

use App\Repositories\RepositoryInterface;

abstract class BaseService
{
    /**
     * The repository instance
     *
     * @var \App\Repositories\RepositoryInterface
     */
    protected $repository;

    /**
     * Create a new service instance.
     *
     * @param \App\Repositories\RepositoryInterface $repository
     * @return void
     */
    public function __construct(RepositoryInterface $repository = null)
    {
        $this->repository = $repository;
    }

    /**
     * Get all records
     *
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all($relations = [])
    {
        return $this->repository->all($relations);
    }

    /**
     * Find a record by ID
     *
     * @param int $id
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find($id, $relations = [])
    {
        return $this->repository->find($id, $relations);
    }

    /**
     * Create a new record
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    /**
     * Update an existing record
     *
     * @param int $id
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    /**
     * Delete a record
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    /**
     * Count all records
     *
     * @return int
     */
    public function count()
    {
        return $this->repository->count();
    }
}