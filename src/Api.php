<?php

namespace WeixinServer;

use WeixinServer\http\HttpClient;

class Api
{
    public function http()
    {
        return new HttpClient();
    }
}
