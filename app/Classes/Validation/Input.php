<?php

namespace Classes\Validation;

class Input {

    public static function exists($type = 'post')
    {
        switch ($type) {
            case 'post':
                return !empty($_POST) ? true : false;
            break;

            case 'get':
                return !empty($_GET) ? true : false;
            break;

            default:
                return false;
            break;
        }
    }

    public static function get($item)
    {
        if (isset($_POST[$item])) {
            return $_POST[$item];

        } elseif (isset($_GET[$item])){
            return $_GET[$item];
        } else {
            return "";
        }
    }

    public static function issetInput($item)
    {
        if (isset($_POST[$item])) {
            return true;

        } elseif (isset($_GET[$item])){
            return true;
        }

        return false;
    }

    public static function file($item)
    {
        if (isset($_FILES[$item])) {
            return $_FILES[$item];

        }

        return "";
    }
}