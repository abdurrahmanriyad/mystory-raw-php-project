<?php namespace Classes\Session;

/**
 * Created by PhpStorm.
 * User: primez
 * Date: 7/21/17
 * Time: 10:57 PM
 */
class Session
{
    public function __construct()
    {
        if(version_compare(phpversion(), '5.4.0', '<')){
            if(session_id() == ""){
                session_start();
            }
        } else{
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
        }
    }

    public static function set($key, $value){
        $_SESSION[$key] = $value;
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

    public function unsetSession($key)
    {
        unset($_SESSION['session_message']);
    }

    public static function checkSession(){
        if(!self::get('login')){
            self::destroy();
        }
    }

}