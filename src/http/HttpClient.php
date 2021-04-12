<?php
 
 namespace WeixinPhpServerApi\http;

 class HttpClient{
    public function test(){
        return "HttpClient Test.";
    }
    /**
	 * 获取登录信息
	 * @param $arr=[] $arr['appid'];$arr['secret'];$arr['code'];
     * 
	 * @return array 获取到的数据
	 */
    public function getWeixinSession($arr=[]) {
        $appid=$arr['appid'];
        $secret=$arr['secret'];
        $code=$arr['code'];
        $wx_id_string=file_get_contents("https://api.weixin.qq.com/sns/jscode2session?appid=$appid&secret=$secret&js_code=$code&grant_type=authorization_code");
        $wx_id_arr=json_decode($wx_id_string,true);
        return $wx_id_arr;
    }
    /**
	 * 获取token信息
	 * @param $arr=[] $arr['appid'];$arr['secret'];
     * 
	 * @return array 获取到的token数据
	 */
    public function getAccessToken($arr=[]){
        $appid=$arr['appid'];
        $secret=$arr['secret'];
        $wx_token_string=file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret");
        $wx_token_arr=json_decode($wx_token_string,true);
        return $wx_token_arr;
    }
    /**
	 * 获取身份证信息信息
	 * @param $arr=[] $arr['appid'];$arr['secret'];$arr['code'];
     * 
	 * @return array 获取到的token数据
	 */
    public function getIdCar($data=[]){
        $url="https://api.weixin.qq.com/cv/ocr/idcard";
        return $this->_sed_post($url,$data);
    }
    /**
	 * 发送POST请示
	 * @param $url string $arr['appid'];$arr['secret'];$arr['code']
     * @param $data=[] array
     * 
	 * @return array 获取到的token数据
	 */
    private function _sed_post($url='',$data=[]){
        $postData=http_build_query($data);
        $options=[
            'https'=>[
                'method'=>'POST',
                'header' => 'Content-type:application/x-www-form-urlencoded',
                'content' => $postData,
                'timeout' => 15 * 60
            ]
        ];
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return $result;
    }
 }