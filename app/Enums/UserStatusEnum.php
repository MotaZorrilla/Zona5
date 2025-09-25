<?php

namespace App\Enums;

class UserStatusEnum extends BaseEnum
{
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';
    const PENDING = 'pending';

    /**
     * Get all descriptions as an associative array
     *
     * @return array
     */
    public static function descriptions(): array
    {
        return [
            self::ACTIVE => 'Activo',
            self::INACTIVE => 'Inactivo',
            self::PENDING => 'Pendiente',
        ];
    }
}