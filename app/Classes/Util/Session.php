<?php namespace Classes\Util;

/**
 * Created by PhpStorm.
 * User: primez
 * Date: 7/21/17
 * Time: 10:57 PM
 */
class Session
{
    public static function exists($name)
    {
        return isset($_SESSION[$name]) ? true : false;
    }

    public static function set($key, $value){
        return $_SESSION[$key] = $value;
    }

    public static function get($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        } else{
            return false;
        }
    }

    public static function destroy(){
        session_destroy();
        session_unset();
        echo '<script> window.location = "login.php";</script>';
    }

    public static function flash($name, $string = '')
    {
        if (self::exists($name)) {
            $session = self::get($name);
            self::unsetSession($name);
            return $session;
        } else {
            self::set($name, $string);
        }
    }

    public static function unsetSession($key)
    {
        unset($_SESSION[$key]);
    }

    public static function checkSession(){
        if(!self::get('login')){
            self::destroy();
        }
    }

}