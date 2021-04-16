<?php

require_once "../vendor/autoload.php";

use CymWeixin\Api;

$ttt = new Api();
$test = $ttt->http();
echo $test->test();
