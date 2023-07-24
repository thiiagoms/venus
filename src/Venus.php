<?php

declare(strict_types=1);

namespace Venus;

use Venus\Services\UrlService;

/**
 * Main scan class
 *
 * @package Venus\Services
 * @author Thiago <thiiagoms@proton.me>
 * @version 1.0
 */
class Venus
{
    /**
     * @var string[]
     */
    private array $validUrls = [];

    /**
     * @var string[]
     */
    private array $invalidUrls = [];

    /**
     * @param UrlService $urlService
     */
    public function __construct(private UrlService $urlService)
    {
    }

    /**
     * @param string[] $urls
     * @return void
     */
    public function scan(array $urls): void
    {
        foreach ($urls as $url) {
            $result = $this->urlService->scan($url);

            $result === true
                ? $this->validUrls[] = $url
                : $this->invalidUrls[] = $url;
        }
    }

    /**
     * @return string[]
     */
    public function getValidUrls(): array
    {
        return $this->validUrls;
    }

    /**
     * @return string[]
     */
    public function getInvalidUrls(): array
    {
        return $this->invalidUrls;
    }
}
