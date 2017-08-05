<?php

namespace Classes\Story;

use Classes\Form\FormFile;
use Classes\Validation\Validation;

require_once "../../../vendor/autoload.php";


class StoryRepository
{
    private $validation;
    private $formFile;

    /**
     * StoryRepository constructor.
     */
    public function __construct()
    {
        $this->validation = new Validation();
        $this->formFile = new FormFile();
    }


    public function createStory(Story $story)
    {
        //validation
        if(!$this->validation->isStoryEmpty($story)){
            $this->formFile->uploadFile($story->featured_image);
        }
    }

    public function getStory()
    {
        
    }

    public function searchStory()
    {
        
    }

    public function getStoryByCategory()
    {
        
    }
}