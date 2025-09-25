<?php

namespace App\Enums;

class RoleEnum extends BaseEnum
{
    const SUPER_ADMIN = 'SuperAdmin';
    const ADMIN = 'Admin';
    const USER = 'User';

    /**
     * Get all descriptions as an associative array
     *
     * @return array
     */
    public static function descriptions(): array
    {
        return [
            self::SUPER_ADMIN => 'Super Administrador',
            self::ADMIN => 'Administrador',
            self::USER => 'Usuario',
        ];
    }
}