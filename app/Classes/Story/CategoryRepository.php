<?php

namespace Classes\Story;
use Classes\Database\DB;
use Classes\Database\DbHelper;
use Classes\Validation\Validation;

class CategoryRepository
{
    private $db;

    public function __construct()
    {
        $this->db =DB::getInstance();
    }

    public function addCategory(Category $category)
    {
        $validation = new Validation();
        if (! $validation->isEmptyString($category->title)) {
            $inserted  = $this->db->insert('category',[
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

        return $this->db->delete('category', ['id', '=', $category_id]);
    }

    public function editCategory(Category $category)
    {
        return $this->db->update('category', $category->id, ["category" => $category->title, "updated_at" => date("Y-m-d h:i:s")]);
    }

    public function getCategoryById($id)
    {
        return $this->db->get('category', ['id', '=', $id])->results();
    }

    public function getCategories()
    {
        return $this->db->all('category');
    }
}