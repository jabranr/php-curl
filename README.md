# PHP cURL [![Build Status](https://travis-ci.org/jabranr/php-curl.svg?branch=master)](https://travis-ci.org/jabranr/php-curl) [![Latest Stable Version](https://poser.pugx.org/jabranr/php-curl/v/stable.svg)](https://packagist.org/packages/php-curl/php-curl) [![Total Downloads](https://poser.pugx.org/jabranr/php-curl/downloads.svg)](https://packagist.org/packages/jabranr/php-curl)

A simple PHP client for cURL operations.

Simply import the library into your project. The best way to do so is to use [Composer](http://getcomposer.org) as following. Otherwise it can simply be downloaded from GitHub and added to the project.

```shell
$ composer require jabranr/php-curl
```

Start using it straight away. (Following example assumes that it was installed via Composer)

```php
<?php

require '/path/to/vendor/autoload.php';

// Start new cURL request
$curl = new Jabran\HttpUtil\HttpCurlRequest('http://jabran.me');

// Set options - method 1
$curl->setOption(CURLOPT_RETURNTRANSFER, true);
$curl->setOption(CURLOPT_FOLLOWLOCATION, true);

// Set options - method 2
$curl->setOptions(array(
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true
));

// Execute request and get response
$response = $curl->execute();

// OR
$curl->execute();
$curl->getResponse();

// Close request
$curl->close();
```


# API

The cURL class exposes following API:

#### `getInfo`

Get cURL request info. `$option` needs to be a valid cURL constant. If none given then it will return an associative array.

```php
$curl->getInfo($option = null);
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


#### `getStatusCode`

Get cURL request HTTP status code.

```php
$curl->getStatusCode();
```


#### `getRequestTime`

Get total time taken for a cURL request.

```php
$curl->getRequestTime();
```


#### `getResponse`

Get response for a cURL request.

```php
$curl->getResponse();
```


# License
Feel free to use and send improvements via pull requests. License under the MIT License.

&copy; Jabran Rafique &ndash; 2016
