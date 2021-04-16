<?php

namespace CymWenxin\http;

class HttpClient
{
    public function test()
    {
        return "HttpClient Test.";
    }
    /**
     * 获取登录信息
     * @param $arr=[] $arr['appid'];$arr['secret'];$arr['code'];
     * 
     * @return array 获取到的数据
     */
    public function getWeixinSession($arr = [])
    {
        $appid = $arr['appid'];
        $secret = $arr['secret'];
        $code = $arr['code'];
        $wx_id_string = file_get_contents("https://api.weixin.qq.com/sns/jscode2session?appid=$appid&secret=$secret&js_code=$code&grant_type=authorization_code");
        $wx_id_arr = json_decode($wx_id_string, true);
        return $wx_id_arr;
    }
    /**
     * 获取token信息
     * @param $arr=[] $arr['appid'];$arr['secret'];
     * 
     * @return array 获取到的token数据
     */
    public function getAccessToken($arr = [])
    {
        $appid = $arr['appid'];
        $secret = $arr['secret'];
        $wx_token_string = file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret");
        $wx_token_arr = json_decode($wx_token_string, true);
        return $wx_token_arr;
    }
}
