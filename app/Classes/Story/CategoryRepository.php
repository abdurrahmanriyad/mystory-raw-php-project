<?php

namespace Classes\Story;
use Classes\Database\DbHelper;
use Classes\Validation\Validation;

class CategoryRepository
{
    private $db_helper;

    public function __construct()
    {
        $this->db_helper = new DbHelper();
    }

    public function addCategory(Category $category)
    {
        $validation = new Validation();
        if (! $validation->isEmptyString($category->title)) {
            $inserted  = $this->db_helper->insert('category',[
                'category' => $category->title,
                'created_at' => date("Y-m-d h:i:s"),
                'updated_at' => date("Y-m-d h:i:s")
            ]);

            return $inserted;
        }

        return false;
    }

    public function removeCategory($category_id)
    {
        return $this->db_helper->delete('category', 'id ='.$category_id);
    }

    public function editCategory(Category $category)
    {
        return $this->db_helper->update('category', ["category" => $category->title, "updated_at" => date("Y-m-d h:i:s")], 'id ='.$category->id);
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