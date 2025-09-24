<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Repository extends Model
{
    protected $fillable = [
        'title',
        'description',
        'file_path',
        'file_name',
        'file_type',
        'category',
        'grade_level',
        'uploaded_by',
        'uploaded_at',
        'file_size',
    ];

    protected $casts = [
        'uploaded_at' => 'datetime',
        'file_size' => 'integer',
    ];

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
