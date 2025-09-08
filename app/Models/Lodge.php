<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lodge extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'number',
        'oriente',
        'history',
        'image_url',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'lodge_user')->withPivot('position_id')->withTimestamps();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
