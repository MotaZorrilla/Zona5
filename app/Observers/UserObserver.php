<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        ActivityLog::create([
            'description' => "Se ha registrado el nuevo usuario: {$user->name}",
            'subject_id' => $user->id,
            'subject_type' => User::class,
            'user_id' => auth()->id(), // or null if created via seeder/console
        ]);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
