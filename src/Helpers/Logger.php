<?php

declare(strict_types=1);

namespace Venus\Helpers;

/**
 * Venus Logger component
 *
 * @package Venus\Helpers
 * @author Thiago <thiiagoms@proton.me>
 * @version 1.0
 */
final class Logger
{
    /**
     * @var string
     */
    private const LOG_PATH = __DIR__ . '/../../logs/';

    /**
     * @param string $message
     * @return void
     */
    public static function log(string $message): void
    {
        $timestamps = date('Y-m-d H:i');
        $timestamps = str_replace('-', '_', $timestamps);
        $timestamps = str_replace(':', '_', $timestamps);

        $fileName = self::LOG_PATH . "log_{$timestamps}.txt";

        $file = fopen($fileName, 'a+');

        if ($file) {
            fwrite($file, "{$message}\n");
            fclose($file);
        }
    }
}
