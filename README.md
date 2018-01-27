# PHP cURL [![Build Status](https://travis-ci.org/jabranr/php-curl.svg?branch=master)](https://travis-ci.org/jabranr/php-curl) [![Latest Stable Version](https://poser.pugx.org/jabranr/php-curl/v/stable.svg)](https://packagist.org/packages/jabranr/php-curl) [![Total Downloads](https://poser.pugx.org/jabranr/php-curl/downloads.svg)](https://packagist.org/packages/jabranr/php-curl)

A simple PHP client for cURL operations.

> __Migrating from v1?__ Beware that v2 has breaking changes! Some of the API methods names have changed.

Simply import the library into your project. The best way to do so is to use [Composer](http://getcomposer.org) as following. Otherwise it can simply be downloaded from GitHub and added to the project.

```shell
$ composer require jabranr/php-curl
```

Start using it straight away. (Following example assumes that it was installed via Composer)

```php
<?php

require 'path/to/vendor/autoload.php';

use Jabran\HttpUtil\HttpCurlRequest;
use Jabran\HttpUtil\Exception\HttpCurlException;

# Start new cURL request
$curl = new HttpCurlRequest('http://jabran.me');
```

Setting cURL options
```php
<?php

# Set options - method 1
$curl->setOption(CURLOPT_RETURNTRANSFER, true);
$curl->setOption(CURLOPT_FOLLOWLOCATION, true);

# Set options - method 2
$curl->setOptions(array(
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true
));

# Execute request, get response and close connection
try {
    $response = $curl->execute();
} catch(HttpCurlException $e) {
    $curl->getErrorCode(); // -> cURL error number
    $curl->getErrorMessage(); // -> cURL error message
    
    # OR
    
    $e->getMessage(); // -> cURL error: [ErrorCode] ErrorMessage
}

# OR get more info and close connection manually
try {
    $response = $curl->execute(false);
} catch(HttpCurlException $e) { }

# Get response later
$response = $curl->getResponse();

# 
$info = $curl->getInfo();

# Close request
$curl->close();
```


# API

The cURL class exposes following API:

#### `getInfo`

Get cURL request info. `$option` needs to be a valid cURL constant. If none given then it will return an associative array.

```php
$curl->execute(false);
$curl->getInfo($option = null);
$curl->close();
```


#### `getError`

Get cURL request error message.

```php
$curl->getError();
```


#### `getErrorCode`

Get cURL request error code.

```php
$curl->getErrorCode();
```


#### `getErrorMessage`

Get cURL request error message.

```php
$curl->getErrorMessage();
```


#### `getHttpCode`

Get cURL request HTTP status code.

```php
$curl->getHttpCode();
```


#### `getTotalTime`

Get total time taken for a cURL request.

```php
$curl->getTotalTime();
```


#### `getResponse`

Get response for a cURL request.

```php
$curl->getResponse();
```


# License
Feel free to use and send improvements via pull requests. Licensed under the MIT License.

&copy; Jabran Rafique &ndash; 2016 &ndash; 2017
