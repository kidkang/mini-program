<?php
namespace Kd\MiniProgram\Command;
use Kd\MiniProgram\Utils;
use Kd\MiniProgram\XcxException;
class AuthCommand extends Command
{
    protected function getContext($code)
    {
        $this->url = sprintf(
            'https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code', 
            $this->appid, 
            $this->appsecret, 
            $code
        );
    }
}
