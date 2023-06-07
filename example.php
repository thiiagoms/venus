<?php

declare(strict_types=1);

require_once 'bootstrap.php';

use Venus\Services\UrlService;

$urls = [
    'https://google.com',
    'https://www.exampleurlthatdoesnotexist.com',
    'https://github.com'
];

/** @var UrlService $app */
$app->scan($urls);

echo '[*] valid urls' . PHP_EOL;
print_r($app->getValidUrls());

echo '[*] invalid urls' . PHP_EOL;
print_r($app->getInvalidUrls());
