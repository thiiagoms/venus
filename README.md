<div align="center">
    <a href="https://github.com/thiiagoms/venus">
        <img src="assets/venus.png" alt="Logo" width="80" height="80">
    </a>
    <h3 align="center">Valid a set of urls :milky_way: </h3>
    <p float="left">
        <img
            src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white"
            alt="PHP"
        >
    </p>
</div>


- [Dependencies](#Dependencies)
- [Install](#Install)
- [Run](#Run)

### Dependencies :heavy_plus_sign:
* PHP 8.1+
* Composer or Docker

### Install :package:

01 -) Clone:
```bash
$ git clone https://github.com/thiiagoms/venus
```

02 -) Change to `venus` directory:
```bash
$ cd venus
venus $
```

03 -) Install dependencies with `composer` package manager:
```bash
venus $ composer install
```

### Run :runner:

01 -) You can execute the `example.php` about how to work with `venus`:
```php
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

/**
* [*] valid urls
* Array
* (
*   [0] => https://google.com
*   [1] => https://github.com
* )
*/

echo '[*] invalid urls' . PHP_EOL;
print_r($app->getInvalidUrls());

/**
* [*] invalid urls
* Array
* (
*   [0] => https://www.exampleurlthatdoesnotexist.com
* )
*/
```

02 -) Run tests:
```bash
venus $ ./vendor/bin/phpunit tests
```