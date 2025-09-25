<?php

namespace App\Repositories;

use App\Models\News;
use Illuminate\Support\Facades\Auth;

class NewsRepository extends AbstractRepository
{
    /**
     * Create a new repository instance.
     *
     * @param \App\Models\News $news
     * @return void
     */
    public function __construct(News $news)
    {
        parent::__construct($news);
    }

    /**
     * Get published news
     *
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPublished($relations = ['author'])
    {
        $query = $this->model->newQuery();

        if (!empty($relations)) {
            $query->with($relations);
        }

        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->get();
    }

    /**
     * Get draft news for the authenticated user
     *
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDrafts($relations = ['author'])
    {
        $query = $this->model->newQuery();

        if (!empty($relations)) {
            $query->with($relations);
        }

        return $query->where('user_id', Auth::id())
            ->where('status', 'draft')
            ->get();
    }

    /**
     * Get scheduled news
     *
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getScheduled($relations = ['author'])
    {
        $query = $this->model->newQuery();

        if (!empty($relations)) {
            $query->with($relations);
        }

        return $query->where('status', 'scheduled')
            ->where('published_at', '>', now())
            ->get();
    }

    /**
     * Publish a news item immediately
     *
     * @param int $id
     * @return bool
     */
    public function publishNow($id)
    {
        $news = $this->find($id);

        if (!$news) {
            return false;
        }

        $news->update([
            'status' => 'published',
            'published_at' => now()
        ]);

        return true;
    }
}