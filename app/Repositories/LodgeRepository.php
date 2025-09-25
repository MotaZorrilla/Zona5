<?php

namespace App\Repositories;

use App\Models\Lodge;

class LodgeRepository extends AbstractRepository
{
    /**
     * Create a new repository instance.
     *
     * @param \App\Models\Lodge $lodge
     * @return void
     */
    public function __construct(Lodge $lodge)
    {
        parent::__construct($lodge);
    }

    /**
     * Find lodge by number
     *
     * @param int $number
     * @param array $relations
     * @return \App\Models\Lodge|null
     */
    public function findByNumber($number, $relations = [])
    {
        $query = $this->model->newQuery();

        if (!empty($relations)) {
            $query->with($relations);
        }

        return $query->where('number', $number)->first();
    }

    /**
     * Get lodges by orient
     *
     * @param string $orient
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByOrient($orient, $relations = ['users'])
    {
        $query = $this->model->newQuery();

        if (!empty($relations)) {
            $query->with($relations);
        }

        return $query->where('orient', $orient)->get();
    }
}