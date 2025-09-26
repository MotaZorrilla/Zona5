<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'start_time',
        'end_time',
        'location',
        'type', // synchronous, asynchronous
        'instructor_name',
        'instructor_role',
        'instructor_image',
        'status', // live, upcoming, closed
        'link',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'status' => 'string',
        'type' => 'string',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}