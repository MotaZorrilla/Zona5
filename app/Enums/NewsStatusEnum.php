<?php

namespace App\Enums;

class NewsStatusEnum extends BaseEnum
{
    const DRAFT = 'draft';
    const PUBLISHED = 'published';
    const SCHEDULED = 'scheduled';

    /**
     * Get all descriptions as an associative array
     *
     * @return array
     */
    public static function descriptions(): array
    {
        return [
            self::DRAFT => 'Borrador',
            self::PUBLISHED => 'Publicado',
            self::SCHEDULED => 'Programado',
        ];
    }
}