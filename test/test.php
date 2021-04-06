<?php

require_once "../vendor/autoload.php";

use WeixinPhpServerApi\Api;

$ttt = new Api();
$test = $ttt->http();
echo $test->test();