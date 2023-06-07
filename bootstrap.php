<?php

declare(strict_types=1);

if (php_sapi_name() != 'cli') {
    echo "<h1>Only in CLI mode</h1>";
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;
use Venus\Helpers\Container;
use Venus\Services\UrlService;

$container = new Container();

$container->add('Client', fn(): object => new Client());
$container->add('UrlService', fn(object $container): object => new UrlService(
    $container->get('Client')
));

$app = $container->get('UrlService');
