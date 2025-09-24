<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

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
        ];
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
