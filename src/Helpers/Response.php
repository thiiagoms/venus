<?php

declare(strict_types=1);

namespace Venus\Helpers;

/**
 * HTTP Response Helper
 *
 * @package Venus\Helpers
 * @author Thiago <thiiagoms@proton.me>
 * @version 1.0
 */
enum Response
{
    case HTTP_OK;

    case HTTP_CREATED;

    case HTTP_ACCEPTED;

    /**
     * @return int
     */
    public function get(): int
    {
        return match ($this) {
            self::HTTP_OK => 200,
            self::HTTP_CREATED => 201,
            self::HTTP_ACCEPTED => 202
        };
    }
}
