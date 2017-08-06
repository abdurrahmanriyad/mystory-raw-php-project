<?php

namespace Classes\Story;

use Classes\Form\FormFile;
use Classes\Validation\Validation;
use Classes\Database\DbHelper;

require_once "../../../vendor/autoload.php";


class StoryRepository
{
    private $validation;
    private $formFile;
    private $db_helper;

    /**
     * StoryRepository constructor.
     */
    public function __construct()
    {
        $this->validation = new Validation();
        $this->formFile = new FormFile();
        $this->db_helper = new DbHelper();
    }


    public function addStory(Story $story)
    {
        return $this->db_helper->insert('story',[
            'title' => $story->title,
            'body' => $story->body,
            'featured_image' => $story->featured_image,
            'user_id' => 1,
            'category_id' => $story->category_id,
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s")
        ]);
    }
    

    public function get()
    {
        
    }

    public function getAllStories($id)
    {

    }

    public function getStoryByCategory()
    {
        
    }
}