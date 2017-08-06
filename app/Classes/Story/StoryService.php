<?php

namespace Classes\Story;

use Classes\Story\Story;
use Classes\Story\StoryRepository;
use Classes\Form\FormFile;
use Classes\Validation\Validation;
use Classes\Database\DbHelper;
class StoryService
{
    private $objValidation;
    private $objFormFile;
    private $db_helper;
    private $objStory;
    private $objStoryRepository;

    public function __construct()
    {
        $this->objValidation = new Validation();
        $this->objFormFile = new FormFile();
        $this->db_helper = new DbHelper();
        $this->objStory = new Story();
        $this->objStoryRepository = new StoryRepository();

    }

    public function submitStory(Story $story)
    {
        //validation
        if (!$this->objValidation->isStoryEmpty($story)) {

            $uplaoded_filename = $this->objFormFile->uploadFile($story->featured_image);
            $story->featured_image = $uplaoded_filename;
            if ($uplaoded_filename) {

                $inserted  = $this->objStoryRepository->addStory($story);
                if ($inserted) {
                    foreach ($story->tags as $temp_tag) {

                        $this->objStory->addPivotStoryTag($inserted, $temp_tag);
                    }
                }

                return $inserted;
            }
        }

        return false;
    }

    public function approveStory()
    {

    }

    public function rejectStory()
    {

    }

    public function deleteStory()
    {

    }

    public function getStoryByCategory()
    {
        
    }

}