<?php
/**
 * Created by PhpStorm.
 * User: primez
 * Date: 8/3/17
 * Time: 12:36 PM
 */

namespace Classes\Story;
use Classes\Database\DbHelper;
use Classes\Validation\Validation;

require_once "../../../vendor/autoload.php";


class Category
{


    public function addCategory($category)
    {
        $validation = new Validation();
        if (! $validation->isEmptyString($category)) {
            $db_helper = new DbHelper();
            $inserted  = $db_helper->insert('category',[
                'category' => $category,
                'created_at' => date("Y-m-d h:i:s"),
                'updated_at' => date("Y-m-d h:i:s")
            ]);

            return $inserted;
        }

        return false;
    }

    public function removeCategory($category_id)
    {
        
    }

    public function getCategoryById()
    {
        
    }

    public function getCategories()
    {
        
    }
}