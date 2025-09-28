<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoneDignitary extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'zone_dignitaries';

    protected $fillable = [
        'name',
        'role',
        'image_url',
        'bio',
    ];
}
