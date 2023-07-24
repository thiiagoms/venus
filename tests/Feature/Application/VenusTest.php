<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Venus\Services\UrlService;
use Venus\Venus;

class VenusTest extends TestCase
{

    /**
     * @return void
     */
    public function test_venus_scan_method(): void
    {
        $urlService = $this->createMock(UrlService::class);
        $venus = new Venus($urlService);

        $urlService->method('scan')->willReturnMap([
            ['https://www.example.com', true],
            ['https://google.com', true],
            ['https://www.invalidurl.com', false]
        ]);

        $urls = [
            'https://www.example.com',
            'https://google.com',
            'https://www.invalidurl.com',
        ];

        $venus->scan($urls);

        $this->assertEquals(['https://www.example.com', 'https://google.com'], $venus->getValidUrls());
        $this->assertEquals(['https://www.invalidurl.com'], $venus->getInvalidUrls());
    }
}
