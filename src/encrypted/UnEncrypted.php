<?php

/**
 * 对微信小程序用户加密数据的解密示例代码.
 *
 * @copyright Copyright (c) 1998-2014 Tencent Inc.
 */

namespace CymWeixin\encrypted;

use WeixinServer\encrypted\ErrorCode;
use WeixinServer\http\HttpClient;

class UnEncrypted
{
	private $appid;
	private $sessionKey;
	private $iv;
	private $encryptedData;

	/**
	 * 构造函数
	 * @param $$arr array $arr=['appid'=>'','secret'=>'','iv'=>'','encryptedData'=>''] 
	 */
	public function __construct($arr = [])
	{
		if (count($arr) == 0 || empty($arr['appid']) || empty($arr['secret']) || empty($arr['code']) || empty($arr['iv']) || empty($arr['encryptedData'])) return ErrorCode::$DataError;
		$sessionKeyObj = new HttpClient();
		$sessionKeyObj = $sessionKeyObj->getWeixinSession($arr);
		$this->iv = $arr['iv'];
		$this->encryptedData = $arr['encryptedData'];
		$this->sessionKey = $sessionKeyObj['session_key'];
		$this->appid = $arr['appid'];
	}


	/**
	 * 检验数据的真实性，并且获取解密后的明文.
	 * @param $data string 解密后的原文
	 *
	 * @return int 成功0，失败返回对应的错误码
	 */
	public function decryptData(&$data)
	{
		if (strlen($this->sessionKey) != 24) {
			return ErrorCode::$IllegalAesKey;
		}
		$aesKey = base64_decode($this->sessionKey);


		if (strlen($this->iv) != 24) {
			return ErrorCode::$IllegalIv;
		}
		$aesIV = base64_decode($this->iv);

		$aesCipher = base64_decode($this->encryptedData);

		$result = openssl_decrypt($aesCipher, "AES-128-CBC", $aesKey, 1, $aesIV);

		$dataObj = json_decode($result);
		if ($dataObj  == NULL) {
			return ErrorCode::$IllegalBuffer;
		}
		if ($dataObj->watermark->appid != $this->appid) {
			return ErrorCode::$IllegalBuffer;
		}
		$data = $result;
		return ErrorCode::$OK;
	}
}
