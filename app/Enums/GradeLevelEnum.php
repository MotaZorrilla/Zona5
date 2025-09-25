<?php

namespace App\Enums;

class GradeLevelEnum extends BaseEnum
{
    const APRENDIZ = 'Aprendiz';
    const COMPAÑERO = 'Compañero';
    const MAESTRO = 'Maestro';
    const TODOS = 'Todos';

    /**
     * Get all descriptions as an associative array
     *
     * @return array
     */
    public static function descriptions(): array
    {
        return [
            self::APRENDIZ => 'Aprendiz',
            self::COMPAÑERO => 'Compañero',
            self::MAESTRO => 'Maestro',
            self::TODOS => 'Todos',
        ];
    }
}