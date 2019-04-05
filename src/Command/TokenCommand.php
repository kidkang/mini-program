<?php
namespace Kd\MiniProgram\Command;
use Kd\MiniProgram\Utils;
use Kd\MiniProgram\XcxException;
class TokenCommand extends Command
{
    protected function getContext($options)
    {
        $this->url = sprintf(
            'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s', 
            $this->appid, 
            $this->appsecret
        );
    }
}
