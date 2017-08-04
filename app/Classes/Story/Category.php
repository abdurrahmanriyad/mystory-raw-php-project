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

    private $db_helper;

    /**
     * Category constructor.
     * @param $db_helper
     */
    public function __construct()
    {
        $this->db_helper = new DbHelper();
    }


    public function addCategory($category)
    {
        $validation = new Validation();
        if (! $validation->isEmptyString($category)) {
            $inserted  = $this->db_helper->insert('category',[
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

    public function editCategory($id, $title)
    {

    }
    
    public function getCategoryById($id)
    {
        return $this->db_helper->select('category', [], ' WHERE id ='.$id);
    }

    public function getCategories()
    {
        return $this->db_helper->select('category', []);
    }
}