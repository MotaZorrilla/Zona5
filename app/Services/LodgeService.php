<?php

namespace App\Services;

use App\Models\Lodge;
use App\Repositories\LodgeRepository;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Storage;

class LodgeService extends BaseService
{
    use FileUploadTrait;
    
    protected $lodgeRepository;

    /**
     * Create a new service instance.
     */
    public function __construct(LodgeRepository $lodgeRepository)
    {
        $this->lodgeRepository = $lodgeRepository;
    }

    /**
     * Create a new lodge
     *
     * @param array $data
     * @param array $files
     * @return \App\Models\Lodge
     */
    public function create(array $data, array $files = [])
    {
        $lodgeData = [
            'name' => $data['name'],
            'number' => $data['number'],
            'orient' => $data['orient'],
            'history' => $data['history'] ?? null,
            'address' => $data['address'] ?? null,
        ];

        // Handle image upload if provided
        if (isset($files['image_url'])) {
            $imagePath = $this->storeFile($files['image_url'], 'lodges', 'public');
            $lodgeData['image_url'] = $imagePath;
        }

        return $this->lodgeRepository->create($lodgeData);
    }

    /**
     * Update an existing lodge
     *
     * @param int $id
     * @param array $data
     * @param array $files
     * @return \App\Models\Lodge|null
     */
    public function update($id, array $data, array $files = [])
    {
        $lodge = $this->find($id);

        if (!$lodge) {
            return null;
        }

        $lodgeData = [
            'name' => $data['name'],
            'number' => $data['number'],
            'orient' => $data['orient'],
            'history' => $data['history'] ?? null,
            'address' => $data['address'] ?? null,
        ];

        // Handle image upload if provided
        if (isset($files['image_url'])) {
            $imagePath = $this->updateFile(
                $files['image_url'],
                $lodge->image_url,
                'lodges',
                [],
                5120, // 5MB max for images
                'public'
            );
            if ($imagePath) {
                $lodgeData['image_url'] = $imagePath;
            }
        }

        $lodge->update($lodgeData);

        return $lodge;
    }

    /**
     * Delete a lodge and its image
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $lodge = $this->find($id);

        if (!$lodge) {
            return false;
        }

        // Delete the image if it exists
        if ($lodge->image_url) {
            $this->deleteFile($lodge->image_url, 'public');
        }

        return $lodge->delete();
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
        return $this->lodgeRepository->findByNumber($number, $relations);
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
        return $this->lodgeRepository->getByOrient($orient, $relations);
    }
    
    /**
     * Find a lodge by ID
     *
     * @param int $id
     * @param array $relations
     * @return \App\Models\Lodge|null
     */
    public function find($id, $relations = [])
    {
        return $this->lodgeRepository->find($id, $relations);
    }
}