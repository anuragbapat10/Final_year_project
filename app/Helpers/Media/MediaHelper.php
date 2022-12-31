<?php

namespace App\Helpers\Media;

use Spatie\MediaLibrary\HasMedia;

/**
 * Class MediaHelper
 * @package App\Helpers\Media
 */
final class MediaHelper
{

    /**
     * @var
     */
    public static $thumbWidth;

    /**
     * @var
     */
    public static $thumbHeight;

    /**
     * @var
     */
    public static $thumbFormat;

    /**
     * @return void
     */
    public static function init()
    {
        if (empty(self::$thumbWidth) || empty(self::$thumbHeight) || empty(self::$thumbFormat)) {
            $config = config('media-library.custom.thumbnail');
            self::$thumbWidth = $config['width'];
            self::$thumbHeight = $config['height'];
            self::$thumbFormat = $config['format'];
        }
    }

    /**
     * @param \Spatie\MediaLibrary\HasMedia $media
     *
     * @return \Spatie\MediaLibrary\Conversions\Conversion
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public static function getThumbnailDefinition(HasMedia $media)
    {
        self::init();

        return $media->addMediaConversion('thumb')
            ->format(self::$thumbFormat)
            ->width(self::$thumbWidth)
            ->height(self::$thumbHeight)
            ->nonQueued();
    }

    /**
     * @param $bytes
     * @param int $precision
     *
     * @return string
     */
    public static function formatBytes($bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        // $bytes /= pow(1024, $pow);
        $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    /**
     * @param int $size
     * @param string $type
     *
     * @return float|int
     */
    public static function convertToBytes(int $size, string $type): float|int
    {
        $types = ["B", "KB", "MB", "GB", "TB", "PB"];

        return $size * pow(1024, array_search($type, $types));
    }
}
