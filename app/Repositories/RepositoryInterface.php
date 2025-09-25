<?php

namespace App\Repositories;

interface RepositoryInterface
{
    /**
     * Get all records
     *
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all($relations = []);

    /**
     * Find a record by ID
     *
     * @param int $id
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find($id, $relations = []);

    /**
     * Create a new record
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data);

    /**
     * Update an existing record
     *
     * @param int $id
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function update($id, array $data);

    /**
     * Delete a record
     *
     * @param int $id
     * @return bool
     */
    public function delete($id);

    /**
     * Count all records
     *
     * @return int
     */
    public function count();
}