<?php

declare(strict_types=1);

namespace Venus\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Url Service package
 *
 * @package Venus\Services
 * @author Thiago <thiiagoms@proton.me>
 * @version 1.0
 */
final class UrlService
{

    private array $validUrls = [];

    private array $invalidUrls = [];

    /**
     * Init service with guzzle client
     *
     * @param Client $guzzle
     */
    public function __construct(private Client $guzzle)
    {
    }

    /**
     * Scan an array of URLs and determine their validity.
     *
     * @param array $urls An array of URLs to scan.
     *
     * @return void
     * @throws GuzzleException
     */
    public function scan(array $urls): void
    {
        foreach($urls as $url) {

            try {
                $response = $this->guzzle->request('GET', $url, [
                    'timeout' => 3
                ]);

                $response->getStatusCode() === 200
                    ? array_push($this->validUrls, $url)
                    : array_push($this->invalidUrls, $url);
            } catch (\GuzzleHttp\Exception\ConnectException $e) {
                $this->invalidUrls[] = $url;
            }
        }
    }

    /**
     * Get the list of valid URLs.
     *
     * @return array The list of valid URLs.
     */
    public function getValidUrls(): array
    {
        return $this->validUrls;
    }

    /**
     * Get the list of invalid URLs.
     *
     * @return array The list of invalid URLs.
     */
    public function getInvalidUrls(): array
    {
        return $this->invalidUrls;
    }
}
