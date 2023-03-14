<?php

include "../useragentparsed/src/UserAgentParsed.php";

$obj = new \Common\Tools\UserAgentParsed();
// $str = "Opera/9.80 (X11; Linux i686; Ubuntu/14.10) Presto/2.12.388 Version/12.16";
// $str = "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36 OPR/86.0.4363.59";
$str = "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:106.0) Gecko/20100101 Firefox/106.0";

echo "<pre>";
echo "1111<br>";
var_dump($obj->getBrowserInfo($str));
var_dump($obj->getSystemOS($str));
var_dump($obj->getAllInfo($str));
die;