<?php
namespace Kd\MiniProgram;

class Auth
{
    private static $url = 'https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code';
    public static function sign($appid, $appsecret, $code)
    {

        $url = sprintf(self::$url, $appid, $appsecret, $code);
        $re  = Utils::https_request($url);
        if (isset($re['errcode'])) {
            throw new XcxException($re['errmsg'],$re['errcode']);
        }
        return $re;
    }
}
