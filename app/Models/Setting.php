<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
    ];

    public static function get($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        
        if (!$setting) {
            return $default;
        }

        // Intentar decodificar como JSON si es posible
        $value = $setting->value;
        if (is_string($value) && !empty($value)) {
            $decoded = json_decode($value, true);
            // Si la decodificación fue exitosa y no es un string, retornamos el valor decodificado
            if ($decoded !== null && json_last_error() === JSON_ERROR_NONE) {
                return $decoded;
            }
        }

        return $value;
    }

    public static function set($key, $value)
    {
        $encodedValue = is_array($value) || is_object($value) ? json_encode($value) : $value;
        
        $setting = self::updateOrCreate(
            ['key' => $key],
            ['value' => $encodedValue]
        );
        
        return $setting;
    }
}