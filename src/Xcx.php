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
    public function __construct($appid,$appsecret){
        $this->appid = $appid;
        $this->appsecret = $appsecret;
        
    }
    /**
     * 获取小程序的登陆信息
     * @param  [type] $code [description]
     * @return boolean|array session_key openid
     */
    public function auth($code){
        return $this->execute(__FUNCTION__, $code);
        
    }
    public function token(){
        return $this->execute(__FUNCTION__,[]);
    }
    public function execute($method,$options){
        $className = ucfirst($method);
        $class = "\\Kd\\MiniProgram\\Command\\".$className.'Command';
        $command = new $class($method);
        return $command->execute($options,$this->appid,$this->appsecret);
    }
}
