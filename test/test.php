<?php

require_once "../vendor/autoload.php";

use WeixinServer\Api;

$ttt = new Api();
$test = $ttt->http();
echo $test->test();
