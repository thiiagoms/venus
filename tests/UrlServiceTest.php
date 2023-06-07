<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use Venus\Services\UrlService;

class UrlServiceTest extends TestCase
{
    /**
     * @throws GuzzleException
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testScan_ValidAndInvalidUrls_ReturnsValidAndInvalidLists()
    {
        $validUrl = 'https://example.com';
        $invalidUrl = 'https://www.exampleurlthatdoesnotexist.com';
        $urls = [$validUrl, $invalidUrl];

        $guzzleMock = $this->createMock(Client::class);

        $validResponseMock = $this->createMock(\GuzzleHttp\Psr7\Response::class);
        $validResponseMock->method('getStatusCode')->willReturn(200);

        $invalidExceptionMock = $this->createMock(ConnectException::class);

        $guzzleMock->method('request')
            ->will($this->returnValueMap([
                ['GET', $validUrl, ['timeout' => 3], $validResponseMock],
                ['GET', $invalidUrl, ['timeout' => 3], $this->throwException($invalidExceptionMock)],
            ]));

        $urlService = new UrlService($guzzleMock);

        $urlService->scan($urls);
        $validUrls = $urlService->getValidUrls();
        $invalidUrls = $urlService->getInvalidUrls();

        $this->assertEquals([$validUrl], $validUrls);
        $this->assertEquals([$invalidUrl], $invalidUrls);
    }
}