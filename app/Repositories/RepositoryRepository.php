<?php

namespace App\Repositories;

use App\Models\Repository;

class RepositoryRepository extends AbstractRepository
{
    /**
     * Create a new repository instance.
     *
     * @param \App\Models\Repository $repository
     * @return void
     */
    public function __construct(Repository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Get repositories by category
     *
     * @param string $category
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByCategory($category, $relations = ['uploader'])
    {
        $query = $this->model->newQuery();

        if (!empty($relations)) {
            $query->with($relations);
        }

        return $query->where('category', $category)->get();
    }

    /**
     * Get repositories by grade level
     *
     * @param string $gradeLevel
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByGradeLevel($gradeLevel, $relations = ['uploader'])
    {
        $query = $this->model->newQuery();

        if (!empty($relations)) {
            $query->with($relations);
        }

        return $query->where('grade_level', $gradeLevel)->get();
    }
}