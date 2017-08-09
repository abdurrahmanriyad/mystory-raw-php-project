<?php
/**
 * Created by PhpStorm.
 * User: primez
 * Date: 8/9/17
 * Time: 3:24 PM
 */

namespace Classes\Util;


class Redirect
{
    public static function to($location = null)
    {
        if ($location) {
            echo '<script> window.location="'.$location.'"</script>';
            exit();
        }
    }
}