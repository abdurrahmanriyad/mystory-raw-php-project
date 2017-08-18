<?php

namespace Classes\Story;

use Classes\Database\DB;
use Classes\Database\DbHelper;

class Story
{
    public $title;
    public $body;
    public $created_at;
    public $rating;
    public $featured_image;
    public $category_id;
    public $tags;
    public $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function addComment(Comment $comment)
    {

    }

    public function deleteComment(Comment $comment)
    {

    }

    public function editComment(Comment $comment)
    {

    }

    public function addCategory(Category $category)
    {
        $this->Category = $category;
    }

    public function addPivotStoryTag($story_id, $tag_id)
    {
        $inserted  = $this->db->insert('story_has_tag',[
            'tag_id' => $tag_id,
            'story_id' => $story_id
        ]);
        return $inserted;
    }

}