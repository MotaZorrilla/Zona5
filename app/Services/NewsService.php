<?php

namespace App\Services;

use App\Enums\NewsStatusEnum;
use App\Models\News;
use App\Repositories\NewsRepository;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NewsService extends BaseService
{
    use FileUploadTrait;
    
    protected $newsRepository;

    /**
     * Create a new service instance.
     */
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * Create a new news entry
     *
     * @param array $data
     * @param array $files
     * @return \App\Models\News
     */
    public function create(array $data, array $files = [])
    {
        $newsData = [
            'user_id' => Auth::id(),
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'excerpt' => $data['excerpt'],
            'content' => $data['content'],
            'status' => $data['status'],
        ];

        // Handle image upload if provided
        if (isset($files['image'])) {
            $imagePath = $this->storeFile($files['image'], 'news/images', 'public');
            $newsData['image_path'] = $imagePath;
        }

        // Handle PDF upload if provided
        if (isset($files['pdf'])) {
            $pdfPath = $this->storeFile($files['pdf'], 'news/pdfs', 'public');
            $newsData['pdf_path'] = $pdfPath;
        }

        // Set published_at based on status
        $newsData['published_at'] = null;
        if ($data['status'] === NewsStatusEnum::PUBLISHED) {
            $newsData['published_at'] = now();
        } elseif ($data['status'] === NewsStatusEnum::SCHEDULED && isset($data['published_at'])) {
            $newsData['published_at'] = $data['published_at'];
        }

        return $this->newsRepository->create($newsData);
    }

    /**
     * Update an existing news entry
     *
     * @param int $id
     * @param array $data
     * @param array $files
     * @return \App\Models\News|null
     */
    public function update($id, array $data, array $files = [])
    {
        $news = $this->find($id);

        if (!$news) {
            return null;
        }

        $newsData = [
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'excerpt' => $data['excerpt'],
            'content' => $data['content'],
            'status' => $data['status'],
        ];

        // Handle image upload if provided
        if (isset($files['image'])) {
            $imagePath = $this->updateFile(
                $files['image'],
                $news->image_path,
                'news/images',
                [],
                2048, // 2MB max for images
                'public'
            );
            if ($imagePath) {
                $newsData['image_path'] = $imagePath;
            }
        }

        // Handle PDF upload if provided
        if (isset($files['pdf'])) {
            $pdfPath = $this->updateFile(
                $files['pdf'],
                $news->pdf_path,
                'news/pdfs',
                ['application/pdf'],
                5120, // 5MB max for PDFs
                'public'
            );
            if ($pdfPath) {
                $newsData['pdf_path'] = $pdfPath;
            }
        }

        // Set published_at based on status
        if ($data['status'] === NewsStatusEnum::PUBLISHED && !$news->published_at) {
            $newsData['published_at'] = now();
        } elseif ($data['status'] === NewsStatusEnum::SCHEDULED && isset($data['published_at'])) {
            $newsData['published_at'] = $data['published_at'];
        } elseif ($data['status'] === NewsStatusEnum::DRAFT) {
            $newsData['published_at'] = null;
        }

        $news->update($newsData);

        return $news;
    }

    /**
     * Get published news
     *
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPublished($relations = ['author'])
    {
        return $this->newsRepository->getPublished($relations);
    }

    /**
     * Get draft news for the authenticated user
     *
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDrafts($relations = ['author'])
    {
        return $this->newsRepository->getDrafts($relations);
    }

    /**
     * Get scheduled news
     *
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getScheduled($relations = ['author'])
    {
        return $this->newsRepository->getScheduled($relations);
    }

    /**
     * Publish a news item immediately
     *
     * @param int $id
     * @return bool
     */
    public function publishNow($id)
    {
        return $this->newsRepository->publishNow($id);
    }
    
    /**
     * Find a news item by ID
     *
     * @param int $id
     * @param array $relations
     * @return \App\Models\News|null
     */
    public function find($id, $relations = [])
    {
        return $this->newsRepository->find($id, $relations);
    }
}