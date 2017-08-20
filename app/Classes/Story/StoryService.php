<?php

namespace Classes\Story;

use Classes\Story\Story;
use Classes\Story\TagRepository;
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
        // remove previous thumbnail and upload new one if there thumbnail
        $uploaded_filename = $this->objFormFile->uploadFile($story->featured_image);
        $story->featured_image = $uploaded_filename;


        // if file uploaded insert story into database
        if ($uploaded_filename) {

            $inserted  = $this->objStoryRepository->addStory($story);
            if ($inserted) {
                if(!empty($story->tags)) {
                    foreach ($story->tags as $temp_tag) {
                        $this->objStory->addPivotStoryTag($inserted, $temp_tag);
                    }
                }
            }

            return $inserted;
        }

        return false;
    }

    public function updateStory(Story $story, $storyId)
    {
        if (isset($story->new_featured_image['name'])) {
            if ($story->new_featured_image['name']) {
                unlink('../../../../uploads/'.$story->featured_image);
                $uploaded_filename = $this->objFormFile->uploadFile($story->new_featured_image, '../../../../uploads/');
                $story->featured_image = $uploaded_filename;
            }
        }

        $updated  = $this->objStoryRepository->updateStory($story, $storyId);

        if ($updated) {
            $this->removeRelatedTags($storyId);

            if(!empty($story->tags)) {
                foreach ($story->tags as $temp_tag) {
                    $this->objStory->addPivotStoryTag($storyId, $temp_tag);
                }
            }

            return $updated;
        }
        return false;
    }


    public function updateStoryActivation(Story $story, $storyId)
    {
        return $this->objStoryRepository->updateStoryActivation($story, $storyId);
    }

    public function deleteStory($id)
    {
        $story = $this->objStoryRepository->get($id);
        if (file_exists("../../../uploads/" . $story->featured_image)) {
            unlink('../../../uploads/'.$story->featured_image);
        }
        $this->objStoryRepository->deleteStory($id);
        $this->objStoryRepository->removeTags($id);



    }

    public function removeRelatedTags($story_id)
    {
        $this->objStoryRepository->removeTags($story_id);
    }

    public function approveStory()
    {

    }

    public function rejectStory()
    {

    }

    public function getStoryByCategory()
    {
        
    }

}