<?php

namespace Classes\Story;

class Story
{
    public $title;
    public $body;
    public $created_at;
    public $rating;



    public function addTag($story_id, $tag_id)
    {
        $inserted  = $this->db_helper->insert('story_has_tag',[
            'tag_id' => $tag_id,
            'story_id' => $story_id
        ]);
        return $inserted;
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
        
    }

}