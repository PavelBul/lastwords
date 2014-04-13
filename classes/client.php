<?php
//Получение инофрмации о клиенте, ip, система, барузер и тп

class Client {

    //IP клиента
    public static function getClientIP()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}