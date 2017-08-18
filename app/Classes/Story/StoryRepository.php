<?php

namespace Classes\Story;

use Classes\Form\FormFile;
use Classes\Story\Story;
use Classes\Validation\Validation;
use Classes\Database\DB;

require_once "../../../vendor/autoload.php";


class StoryRepository
{
    private $validation;
    private $formFile;
    private $db;

    /**
     * StoryRepository constructor.
     */
    public function __construct()
    {
        $this->validation = new Validation();
        $this->formFile = new FormFile();
        $this->db = DB::getInstance();
    }


    public function addStory(Story $story)
    {
         $this->db->insert('story',[
            'title' => $story->title,
            'body' => $story->body,
            'featured_image' => $story->featured_image,
            'user_id' => 1,
            'category_id' => $story->category_id,
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s")
        ]);

        return $this->db->lastInsertedId();
    }

    public function updateStory(Story $story, $id)
    {
        return $this->db->update('story', $id, [
            'title' => $story->title,
            'body' => $story->body,
            'featured_image' => $story->featured_image,
            'user_id' => 1,
            'category_id' => $story->category_id,
            'updated_at' => date("Y-m-d h:i:s")
        ]);
    }

    public function get($id)
    {

        $story = $this->db->query(
            "SELECT story.*, category.category FROM story INNER JOIN category on story.category_id = category.id WHERE story.id = {$id}"
        );


        if ($story->count()) {
            $story = $story->first();
            $objStory = new Story();
            $objStory->title = $story->title;
            $objStory->body = $story->body;
            $objStory->category_id = $story->category_id;
            $objStory->featured_image = $story->featured_image;

            $tags = $this->db->query(
                "SELECT * FROM tag WHERE id IN (SELECT tag_id from story_has_tag WHERE story_id = {$id})"
            );

            if ($tags->count()) {
                $objStory->tags = $tags->results();
            }

        }

        return $objStory;
    }

    public function removeTags($id)
    {
        return  $this->db->delete('story_has_tag',['story_id', '=', $id]);
    }

    public function getAllStories()
    {
        return $this->db->query(
            "SELECT story.*, story_has_tag.tag_id, tag.tag, category.category FROM story LEFT JOIN story_has_tag ON story.id = story_has_tag.story_id LEFT JOIN tag ON story_has_tag.tag_id = tag.id INNER JOIN category on story.category_id = category.id"
        )->results();

    }

    public function getStoryByCategory()
    {
        
    }
}