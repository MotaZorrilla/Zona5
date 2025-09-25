<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $name
 * @property int $number
 * @property string $orient
 * @property string|null $history
 * @property string|null $image_url
 * @property string|null $address
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */
class Lodge extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'number',
        'orient',
        'history',
        'image_url',
        'address',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($lodge) {
            if (empty($lodge->slug)) {
                $lodge->slug = Str::slug($lodge->name . '-' . $lodge->number);
            }
        });
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'lodge_user')
            ->withPivot('position_id')
            ->withTimestamps();
    }
}
