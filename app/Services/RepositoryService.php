<?php

namespace App\Services;

use App\Enums\GradeLevelEnum;
use App\Models\Repository;
use App\Repositories\RepositoryRepository;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RepositoryService extends BaseService
{
    use FileUploadTrait;
    
    protected $repositoryRepository;

    /**
     * Create a new service instance.
     */
    public function __construct(RepositoryRepository $repositoryRepository)
    {
        $this->repositoryRepository = $repositoryRepository;
    }

    /**
     * Get all repositories with uploader relationship
     *
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allWithUploader($relations = ['uploader'])
    {
        return $this->repositoryRepository->all($relations);
    }

    /**
     * Create a new repository entry
     *
     * @param array $data
     * @param array $files
     * @return \App\Models\Repository
     */
    public function create(array $data, array $files = [])
    {
        $repositoryData = [
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'category' => $data['category'] ?? null,
            'grade_level' => $data['grade_level'] ?? GradeLevelEnum::TODOS,
            'uploaded_by' => Auth::id(),
            'uploaded_at' => now(),
        ];

        // Handle document upload if provided
        if (isset($files['document'])) {
            $file = $files['document'];
            $filePath = $this->storeFile($file, 'repository', 'public');
            
            $repositoryData['file_path'] = $filePath;
            $repositoryData['file_name'] = $file->getClientOriginalName();
            $repositoryData['file_type'] = $file->getClientOriginalExtension();
            $repositoryData['file_size'] = $file->getSize();
        }

        return $this->repositoryRepository->create($repositoryData);
    }

    /**
     * Update a repository entry
     *
     * @param int $id
     * @param array $data
     * @param array $files
     * @return \App\Models\Repository|null
     */
    public function update($id, array $data, array $files = [])
    {
        $repository = $this->find($id);

        if (!$repository) {
            return null;
        }

        $repositoryData = [
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'category' => $data['category'] ?? null,
            'grade_level' => $data['grade_level'] ?? GradeLevelEnum::TODOS,
        ];

        // Handle document upload if provided
        if (isset($files['document'])) {
            $file = $files['document'];
            $oldFilePath = $repository->file_path;
            
            // Update the file using the trait method
            $filePath = $this->updateFile(
                $file,
                $oldFilePath,
                'repository',
                [],
                10240, // 10MB max
                'public'
            );
            
            if ($filePath) {
                $repositoryData['file_path'] = $filePath;
                $repositoryData['file_name'] = $file->getClientOriginalName();
                $repositoryData['file_type'] = $file->getClientOriginalExtension();
                $repositoryData['file_size'] = $file->getSize();
            }
        }

        $repository->update($repositoryData);

        return $repository;
    }

    /**
     * Delete a repository entry and its file
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $repository = $this->find($id);

        if (!$repository) {
            return false;
        }

        // Delete the file from storage
        if ($repository->file_path) {
            $this->deleteFile($repository->file_path, 'public');
        }

        return $repository->delete();
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
        return $this->repositoryRepository->getByCategory($category, $relations);
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
        return $this->repositoryRepository->getByGradeLevel($gradeLevel, $relations);
    }
    
    /**
     * Find a repository by ID
     *
     * @param int $id
     * @param array $relations
     * @return \App\Models\Repository|null
     */
    public function find($id, $relations = [])
    {
        return $this->repositoryRepository->find($id, $relations);
    }
}