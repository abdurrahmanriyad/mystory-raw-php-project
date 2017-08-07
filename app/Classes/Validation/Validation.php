<?php
/**
 * Created by PhpStorm.
 * User: primez
 * Date: 8/4/17
 * Time: 6:09 PM
 */

namespace Classes\Validation;

require_once $_SERVER['DOCUMENT_ROOT']."/storyteller/vendor/autoload.php";

use \Classes\Database\DB;

class Validation
{

    private $errors = array();
    private $passed = false;
    private $db = null;


    public function __construct()
    {
        $this->db = DB::getInstance();
    }
    
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

    public function validate($source, $items = array())
    {
        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {

                $value = trim($source[$item]);

                if ($rule === 'required' && empty($value)) {
                    $this->addError("{$item} is required");

                } else if(!empty($value)){
                    switch ($rule) {
                        case 'min':
                            if(strlen($value) < $rule_value) {
                                $this->addError("{$item} must be a minimum of {$rule_value} characters");
                            }
                        break;

                        case 'max':
                            if(strlen($value) > $rule_value) {
                                $this->addError("{$item} must be a maximum of {$rule_value} characters");
                            }
                        break;

                        case 'matches':
                            if($value != $source[$rule_value]) {
                                $this->addError("{$rule_value} must matches {$item}");
                            }
                        break;

                        case 'unique':
                            $check = $this->db->get($rule_value, array($item, '=', $value));

                            if($check->count()) {
                                $this->addError("{$item} already exists");
                            }
                        break;

                    }
                }
            }

        }

        if(empty($this->errors)) {
            $this->passed = true;
        } else {
            print_r($this->errors());
        }

        return '';
    }

    public function addError($error)
    {
        $this->errors[] = $error;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function passed()
    {
        return $this->passed;
    }
}