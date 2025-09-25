<?php

namespace App\Models;

use App\Enums\GradeLevelEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string|null $file_path
 * @property string|null $file_name
 * @property string|null $file_type
 * @property int|null $file_size
 * @property string|null $category
 * @property string $grade_level
 * @property int $uploaded_by
 * @property \Carbon\Carbon $uploaded_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */
class Repository extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
        'category',
        'grade_level',
        'uploaded_by',
        'uploaded_at',
    ];

    protected $dates = ['uploaded_at'];

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function scopeForGradeLevel($query, $gradeLevel)
    {
        return $query->where('grade_level', $gradeLevel);
    }

    public function scopeForAprendiz($query)
    {
        return $query->where('grade_level', GradeLevelEnum::APRENDIZ);
    }

    public function scopeForCompanero($query)
    {
        return $query->where('grade_level', GradeLevelEnum::COMPAÑERO);
    }

    public function scopeForMaestro($query)
    {
        return $query->where('grade_level', GradeLevelEnum::MAESTRO);
    }

    public function scopeForAll($query)
    {
        return $query->where('grade_level', GradeLevelEnum::TODOS);
    }
}
