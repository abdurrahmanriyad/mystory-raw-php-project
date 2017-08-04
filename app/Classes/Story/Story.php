<?php

namespace Classes\Story;

class Story
{
    private $title;
    private $body;
    private $created_at;

    /**
     * Story constructor.
     * @param $title
     * @param $body
     * @param $created_at
     */
    public function __construct($title, $body, $created_at)
    {
        $this->title = $title;
        $this->body = $body;
        $this->created_at = $created_at;
    }

    public function approveStory($story_id)
    {

    }

    public function rejectStory($story_id)
    {
        
    }

}