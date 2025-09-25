<?php

namespace App\Enums;

class MessageStatusEnum extends BaseEnum
{
    const UNREAD = 'unread';
    const READ = 'read';
    const ARCHIVED = 'archived';

    /**
     * Get all descriptions as an associative array
     *
     * @return array
     */
    public static function descriptions(): array
    {
        return [
            self::UNREAD => 'No leído',
            self::READ => 'Leído',
            self::ARCHIVED => 'Archivado',
        ];
    }
}