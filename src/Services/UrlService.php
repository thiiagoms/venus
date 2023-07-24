<?php

declare(strict_types=1);

namespace Venus\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use Venus\Helpers\Logger;
use Venus\Helpers\Response;

/**
 * Url Service package
 *
 * @package Venus\Services
 * @author Thiago <thiiagoms@proton.me>
 * @version 1.0
 */
class UrlService
{
    /**
     * Init service with guzzle client
     *
     * @param Client $guzzle
     */
    public function __construct(private Client $guzzle)
    {
    }

    /**
     * Scan url and check if it's avaiable or not
     *
     * @param string $url
     * @return bool
     * @throws GuzzleException
     */
    public function scan(string $url): bool
    {
        try {
            $response = $this->guzzle->request('GET', $url, ['timeout' => 3]);
            return $response->getStatusCode() == Response::HTTP_OK->get();

        } catch (ConnectException $e) {
            Logger::log("Invalid to connect at {$url}: {$e->getMessage()}");
            return false;
        }
    }
}
