<?php
namespace WeixinPhpServerApi;

use WeixinPhpServerApi\http\HttpClient;

class Api{
    public function http(){
        return new HttpClient();
    }
}