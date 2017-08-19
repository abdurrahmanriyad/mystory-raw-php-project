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

    public function addComment(Comment $comment, $user_id, $story_id)
    {
        return $this->db->insert('comment', [
            'comment' => $comment->getComment(),
            'user_id' => $user_id,
            'story_id' => $story_id,
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s")
        ]);
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

    public function getComments()
    {
        $result = $this->db->query('SELECT COMMENT.*, user.name, user.photo_url from comment INNER JOIN user on comment.user_id = user.id');
        return $result->results();
    }

}