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
}