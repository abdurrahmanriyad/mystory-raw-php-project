<?php
/**
 * Created by PhpStorm.
 * User: primez
 * Date: 8/4/17
 * Time: 6:09 PM
 */

namespace Classes\Validation;

require_once "../../../vendor/autoload.php";


use Classes\Story\Story;

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

    public function areFieldsEmpty(array $fields){
        foreach($fields as $field) {
            if ($field == "") {
                return true;
            }
        }

        return false;
    }

    public function isStoryEmpty(Story $story){

        if (trim($story->title) == '') {
            return true;
        } else if (trim($story->body) == '') {
            return true;
        } else if (!isset($story->category_id)) {
            return true;
        } else if (empty($story->tags)) {
            return true;
        }

        return false;
    }
}