<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'grade_level',
        'image_url',
        'instructor_name',
        'instructor_role',
        'instructor_image',
        'duration',
        'status', // active, inactive, upcoming
        'type', // synchronous, asynchronous
        'link',
    ];

    protected $casts = [
        'duration' => 'integer', // duration in hours
        'status' => 'string',
        'type' => 'string',
    ];
}