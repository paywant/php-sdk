<?php

namespace Paywant\Utilities;

class Helper
{
    public static function getIPAddress()
    {
        $ipaddress = '0.0.0.0';

        if (getenv('HTTP_CLIENT_IP'))
        {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        }
        elseif (getenv('HTTP_X_FORWARDED_FOR'))
        {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        }
        elseif (getenv('HTTP_X_FORWARDED'))
        {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        }
        elseif (getenv('HTTP_FORWARDED_FOR'))
        {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        }
        elseif (getenv('HTTP_FORWARDED'))
        {
            $ipaddress = getenv('HTTP_FORWARDED');
        }
        elseif (getenv('REMOTE_ADDR'))
        {
            $ipaddress = getenv('REMOTE_ADDR');
        }

        return $ipaddress;
    }

    public static function getPort()
    {
        return getenv('REMOTE_PORT');
    }
}
