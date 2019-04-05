<?php
namespace Kd\MiniProgram\Command;
use Kd\MiniProgram\XcxException;
use Kd\MiniProgram\Utils;
abstract class Command
{
    protected $appid;
    protected $appsecret;
    protected $url;
    abstract protected function getContext($options);
    protected function request(){
        return Utils::https_request($this->url);
    }
    public function execute($options, $appid, $appsecret)
    {
        $this->appid     = $appid;
        $this->appsecret = $appsecret;
        $this->getContext($options);
        $re = $this->request();
        if (isset($re['errcode'])) {
            throw new XcxException($re['errmsg'],$re['errcode']);
        }
        return $re;
    }
}
