<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Venus\Helpers\Response as VenusResponse;
use Venus\Services\UrlService;

class UrlServiceTest extends TestCase
{
    /**
     * @var Client
     */
    private Client $guzzleMock;

    /**
     * @var array|string[]
     */
    private array $url = ['success' => 'https://google.com', 'failure' => 'https://www.invalidurl.com'];


    /**
     * @return void
     */
    protected function setUp (): void
    {
        parent::setUp();
        $this->guzzleMock = $this->createMock(Client::class);
    }

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function test_scan_url_method_must_return_true(): void
    {
        $responseMock = $this->createMock(Response::class);
        $responseMock->method('getStatusCode')->willReturn(VenusResponse::HTTP_OK->get());

        $this->guzzleMock->method('request')->willReturn($responseMock);

        $urlService = new UrlService($this->guzzleMock);

        $result = $urlService->scan($this->url['success']);

        $this->assertTrue($result);
    }

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function test_scan_url_method_must_return_false_when_get_exception(): void
    {
        $this->guzzleMock->method('request')
            ->willThrowException(
                new ConnectException(
                    'Failed to connect',
                    new \GuzzleHttp\Psr7\Request('GET', $this->url['failure'])
                )
            );

        $urlService = new UrlService($this->guzzleMock);

        $result = $urlService->scan($this->url['failure']);

        $this->assertFalse($result);
    }
}
