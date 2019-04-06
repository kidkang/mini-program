<?php
namespace Kd\MiniProgram;

class Xcx
{

    /**
     *
     */

    /**
     * access_token_url
     * @var string
     */
    private $token_url = '';
    /**
     * 错误码
     * @var [integer]
     */
    private $errCode;
    /**
     * 错误信息
     * @var string
     */
    private $errMsg;
    /**
     * 当前当前错误代码
     * @return int
     */
    public function __construct($appid, $appsecret)
    {
        $this->appid     = $appid;
        $this->appsecret = $appsecret;

    }
    /**
     * 获取小程序的登陆信息
     * @param  [type] $code [description]
     * @return boolean|array session_key openid
     */
    public function auth($code)
    {
        return $this->execute(__FUNCTION__, $code);

    }
    public function token()
    {
        return $this->execute(__FUNCTION__, []);
    }
    public function decryptData($session_key, $encryptedData, $iv)
    {
        if (strlen($session_key) != 24) {
            throw new XcxException('encodingAesKey not access', 41001);
        }
        $aesKey = base64_decode($session_key);
        if (strlen($iv) != 24) {
            throw new XcxException('iv not access', 41002);
        }
        $aesIV     = base64_decode($iv);
        $aesCipher = base64_decode($encryptedData);
        $result    = openssl_decrypt($aesCipher, "AES-128-CBC", $aesKey, 1, $aesIV);
        $dataObj   = json_decode($result);
        if ($dataObj == null) {
            throw new XcxException('ace fail', 41003);
        }
        if ($dataObj->watermark->appid != $this->appid) {
            throw new XcxException('appid not access '.$dataObj->watermark->appid, 41004);
        }
        return $dataObj;
    }
    public function execute($method, $options)
    {
        $className = ucfirst($method);
        $class     = "\\Kd\\MiniProgram\\Command\\" . $className . 'Command';
        $command   = new $class($method);
        return $command->execute($options, $this->appid, $this->appsecret);
    }
}
