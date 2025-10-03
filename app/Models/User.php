<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Casts\Attribute;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'national_id',
        'birth_date',
        'initiation_date',
        'degree',
        'profession',
        'phone_number',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => 'string',
        ];
    }
    
    /**
     * Set the default value for the status attribute
     */
    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?? 'pending',
        );
    }
    
    /**
     * Check if user is active
     */
    public function isActive(): bool
    {
        return $this->status === \App\Enums\UserStatusEnum::ACTIVE;
    }
    
    /**
     * Check if user is pending
     */
    public function isPending(): bool
    {
        return $this->status === \App\Enums\UserStatusEnum::PENDING;
    }
    
    /**
     * Check if user is inactive
     */
    public function isInactive(): bool
    {
        return $this->status === \App\Enums\UserStatusEnum::INACTIVE;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function lodges()
    {
        return $this->belongsToMany(Lodge::class, 'lodge_user')->withPivot('position_id')->withTimestamps();
    }

    public function positions()
    {
        return $this->belongsToMany(Position::class, 'lodge_user', 'user_id', 'position_id')
                    ->withPivot('lodge_id')
                    ->withTimestamps();
    }
    
    /**
     * Get the user's unread notifications.
     */
    public function unreadNotifications()
    {
        return $this->notifications()->whereNull('read_at');
    }
}
