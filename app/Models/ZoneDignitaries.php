<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoneDignitaries extends Model
{
    use HasFactory;

    protected $table = 'zone_dignitaries';

    protected $fillable = [
        'name',
        'role',
        'image_url',
        'bio',
        'size'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}