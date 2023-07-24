<?php

declare(strict_types=1);

if (php_sapi_name() != 'cli') {
    echo "<h1>Only in CLI mode</h1>";
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;
use Venus\{
    Helpers\Container,
    Services\UrlService,
    Venus
};

$container = new Container();

$container->add('Client', fn (): object => new Client());
$container->add('UrlService', fn (object $container): UrlService => new UrlService(
    $container->get('Client')
));
$container->add('Venus', fn (object $container): Venus => new Venus(
    $container->get('UrlService')
));

/** @var Venus $app */
$app = $container->get('Venus');
