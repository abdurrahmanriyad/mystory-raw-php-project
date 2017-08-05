<?php

namespace Classes\Story;

class Story
{
    public $title;
    public $body;
    public $category_id;
    public $tags;
    public $featured_image;

    public function approveStory($story_id)
    {

    }

    public function rejectStory($story_id)
    {
        
    }

    public function toString()
    {
        return "Title: ".$this->title."</br> ". "Body: ".$this->body."</br> ". "Category_id: ".$this->category_id."</br> "."Tag_id: ".$this->tag_id[0]."</br> ";
    }

}