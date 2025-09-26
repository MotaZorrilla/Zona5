<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    public static function bootLogsActivity()
    {
        static::created(function ($model) {
            static::logActivity("created_{$model->getTable()}", $model);
        });

        static::updated(function ($model) {
            static::logActivity("updated_{$model->getTable()}", $model);
        });

        static::deleted(function ($model) {
            static::logActivity("deleted_{$model->getTable()}", $model);
        });
    }

    protected static function logActivity($description, $model)
    {
        if (app()->runningInConsole()) {
            return; // No registrar actividades desde comandos de consola
        }

        ActivityLog::create([
            'description' => static::formatDescription($description, $model),
            'subject_id' => $model->id,
            'subject_type' => get_class($model),
            'user_id' => Auth::id(),
        ]);
    }

    protected static function formatDescription($action, $model)
    {
        $modelName = class_basename($model);
        $tableName = $model->getTable();
        
        // Obtener un nombre más amigable para cada modelo
        $modelNames = [
            'users' => 'Miembro',
            'events' => 'Evento',
            'news' => 'Noticia',
            'lodges' => 'Logia',
            'treasuries' => 'Movimiento de Tesorería',
            'repositories' => 'Documento',
            'messages' => 'Mensaje',
            'zone_dignitaries' => 'Dignatario',
        ];
        
        $friendlyName = $modelNames[$tableName] ?? $modelName;
        
        // Función para obtener el valor del modelo
        $getValue = function($model) {
            return $model->name ?? $model->title ?? $model->description ?? $model->id;
        };
        
        switch ($action) {
            case "created_{$tableName}":
                return "Ha creado un nuevo {$friendlyName}: " . $getValue($model);
            case "updated_{$tableName}":
                return "Ha actualizado el {$friendlyName}: " . $getValue($model);
            case "deleted_{$tableName}":
                return "Ha eliminado el {$friendlyName}: " . $getValue($model);
            default:
                return $action . " on {$friendlyName}";
        }
    }
}