<?php

namespace App\Enums;

class FileTypeEnum extends BaseEnum
{
    const DOCUMENT = 'document';
    const IMAGE = 'image';
    const PDF = 'pdf';
    const VIDEO = 'video';
    const AUDIO = 'audio';

    /**
     * Get all descriptions as an associative array
     *
     * @return array
     */
    public static function descriptions(): array
    {
        return [
            self::DOCUMENT => 'Documento',
            self::IMAGE => 'Imagen',
            self::PDF => 'PDF',
            self::VIDEO => 'Vídeo',
            self::AUDIO => 'Audio',
        ];
    }
}