<?php
/**
 * Created by PhpStorm.
 * User: primez
 * Date: 8/4/17
 * Time: 6:09 PM
 */

namespace Classes\Validation;


class Validation
{
    public function isEmptyString($str = "")
    {
        if (trim($str) == '')
        {
            return true;
        }

        return false;
    }
}