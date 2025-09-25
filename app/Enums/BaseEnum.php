<?php

namespace App\Enums;

abstract class BaseEnum
{
    /**
     * Get all enum values
     *
     * @return array
     */
    public static function values(): array
    {
        $class = get_called_class();
        $constants = (new \ReflectionClass($class))->getConstants();
        return array_values($constants);
    }

    /**
     * Get all enum keys
     *
     * @return array
     */
    public static function keys(): array
    {
        $class = get_called_class();
        $constants = (new \ReflectionClass($class))->getConstants();
        return array_keys($constants);
    }

    /**
     * Check if a value exists in the enum
     *
     * @param mixed $value
     * @return bool
     */
    public static function isValid($value): bool
    {
        return in_array($value, static::values());
    }

    /**
     * Get the human-readable description for a value
     *
     * @param mixed $value
     * @return string|null
     */
    public static function getDescription($value): ?string
    {
        $descriptions = static::descriptions();
        return $descriptions[$value] ?? null;
    }

    /**
     * Get all descriptions as an associative array
     *
     * @return array
     */
    public static function descriptions(): array
    {
        return [];
    }
}