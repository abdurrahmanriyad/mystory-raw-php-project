<?php

namespace Classes\Story;

use Classes\Form\FormFile;
use Classes\Story\Story;
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

    public function updateStory(Story $story, $id)
    {
        return $this->db_helper->update('story',[
            'title' => $story->title,
            'body' => $story->body,
            'featured_image' => $story->featured_image,
            'user_id' => 1,
            'category_id' => $story->category_id,
            'updated_at' => date("Y-m-d h:i:s")
        ], $id);
    }

    public function get($id)
    {
        $results = $this->db_helper->query(
            "SELECT story.*, story_has_tag.tag_id, tag.tag, tag.id as tag_id, category.category FROM story INNER JOIN story_has_tag ON story.id = story_has_tag.story_id AND story.id = {$id} INNER JOIN tag ON story_has_tag.tag_id = tag.id INNER JOIN category on story.category_id = category.id"
        );

//        var_dump($results);
        $tags = [];
        foreach ($results as $result) {
            $tags[] = $result->tag_id;
        }

        $story = new Story();
        $story->title = $results[0]->title;
        $story->body = $results[0]->body;
        $story->category_id = $results[0]->category_id;
        $story->featured_image = $results[0]->featured_image;
        $story->tags = $tags;

        return $story;
    }

    public function removeTags($id)
    {
        return  $this->db_helper->delete('story_has_tag', "story_id = ".$id);
    }

    public function getAllStories()
    {
        return $this->db_helper->query(
            "SELECT story.*, story_has_tag.tag_id, tag.tag, category.category FROM story LEFT JOIN story_has_tag ON story.id = story_has_tag.story_id LEFT JOIN tag ON story_has_tag.tag_id = tag.id INNER JOIN category on story.category_id = category.id"
        );

    }

    public function getStoryByCategory()
    {
        
    }
}