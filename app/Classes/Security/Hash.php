<?php
namespace Classes\Security;

/**
 * Created by PhpStorm.
 * User: primez
 * Date: 8/9/17
 * Time: 1:00 PM
 */
class Hash
{
    public static function make($string, $salt = '')
    {
        return hash('sha256', $string.$salt);
    }

    public static function salt($length)
    {
        return mcrypt_create_iv($length);
    }

    public static function unique()
    {
        return self::make(uniqid());

    }
}