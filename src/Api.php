<?php

namespace CymWeixin;

use CymWeixin\http\HttpClient;

class Api
{
    public function http()
    {
        return new HttpClient();
    }
}
