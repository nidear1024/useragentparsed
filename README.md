# useragentparsed
Analysis of the useragent in the request head




## Requirements
------------
 - PHP >= 7.0.0

## Installation
------------

> This package requires PHP 7+

First, install useragentparsed.

```sh
composer require nidear1024/useragentparsed
```

Then run these commands to test：

```sh
cd useragentparsed
php ./test/index.php
```
## Usage

```php
include "./vendor/autoload.php";


$str = "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:106.0) Gecko/20100101 Firefox/106.0";
$str = getallheaders()['User-Agent'];

$obj = new \Common\Tools\UserAgentParsed();
echo "<pre>";
var_dump($obj->getBrowserInfo($str));
var_dump($obj->getSystemOS($str));
var_dump($obj->checkSpider($str));
var_dump($obj->getMachineType($str));
var_dump($obj->getAllInfo($str));
die;
```
