<?php

namespace App\Enums;

class StatusEnum extends BaseEnum
{
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';
    const PENDING = 'pending';
    const APPROVED = 'approved';
    const REJECTED = 'rejected';
    const CANCELLED = 'cancelled';
    const COMPLETED = 'completed';

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
            self::APPROVED => 'Aprobado',
            self::REJECTED => 'Rechazado',
            self::CANCELLED => 'Cancelado',
            self::COMPLETED => 'Completado',
        ];
    }
}