<?php

namespace App\Repositories;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageRepository extends AbstractRepository
{
    /**
     * Create a new repository instance.
     *
     * @param \App\Models\Message $message
     * @return void
     */
    public function __construct(Message $message)
    {
        parent::__construct($message);
    }

    /**
     * Get messages for the authenticated user
     *
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMessagesForUser($relations = [])
    {
        $query = $this->model->newQuery();

        if (!empty($relations)) {
            $query->with($relations);
        }

        return $query->where('recipient_id', Auth::id())
            ->whereIn('status', ['unread', 'read'])
            ->get();
    }

    /**
     * Get archived messages for the authenticated user
     *
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getArchivedMessages($relations = [])
    {
        $query = $this->model->newQuery();

        if (!empty($relations)) {
            $query->with($relations);
        }

        return $query->where('recipient_id', Auth::id())
            ->archived()
            ->get();
    }

    /**
     * Get deleted messages for the authenticated user
     *
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDeletedMessages($relations = [])
    {
        $query = $this->model->newQuery();

        if (!empty($relations)) {
            $query->with($relations);
        }

        return $query->where('recipient_id', Auth::id())
            ->onlyTrashed()
            ->get();
    }
}