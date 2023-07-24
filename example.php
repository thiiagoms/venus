<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

$urls = [
    'https://google.com',
    'https://www.exampleurlthatdoesnotexist.com',
    'https://github.com'
];

/** @var \Venus\Venus $app */
$app->scan($urls);

echo '[*] valid urls' . PHP_EOL;
print_r($app->getValidUrls());

echo '[*] invalid urls' . PHP_EOL;
print_r($app->getInvalidUrls());
