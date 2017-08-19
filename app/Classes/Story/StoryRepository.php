<?php

namespace Classes\Story;

use Classes\Form\FormFile;
use Classes\Story\Story;
use Classes\Validation\Validation;
use Classes\Database\DB;


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

    public function updateStory(Story $story, $storyId)
    {
        return $this->db->update('story', $storyId, [
            'title' => $story->title,
            'body' => $story->body,
            'featured_image' => $story->featured_image,
            'user_id' => 1,
            'category_id' => $story->category_id,
            'updated_at' => date("Y-m-d h:i:s")
        ]);
    }

    public function updateStoryActivation(Story $story, $storyId)
    {
        return $this->db->update('story', $storyId, [
            'active' => $story->active,
            'updated_at' => date("Y-m-d h:i:s")
        ]);
    }
    
    public function get($id)
    {
        $objStory = new Story();

        $story = $this->db->query(
            "SELECT story.*, category.category FROM story INNER JOIN category on story.category_id = category.id WHERE story.id = {$id}"
        );


        if ($story->count()) {
            $story = $story->first();
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

    public function deleteStory($id)
    {
        return $this->db->delete('story', ['id', '=', $id]);
    }
    
    public function removeTags($id)
    {
        return  $this->db->delete('story_has_tag',['story_id', '=', $id]);
    }

    public function getAllStories()
    {
        return $this->db->all('story');
    }

    public function getStoriesByCategory($category = '')
    {
        $objCategory = $this->db->get('category', ['category', '=', $category])->first();
        return $this->db->get('story', ['category_id', '=', $objCategory->id])->results();
    }

    public function getStoriesByTag($tag = '')
    {
        $objTag = $this->db->get('tag', ['tag', '=', $tag])->results();
        return $this->db->query('SELECT story.*, story_has_tag.tag_id FROM story INNER JOIN story_has_tag on story.id = story_has_tag.story_id WHERE tag_id ='.$objTag->id)->results();
    }

    public function getStoryBySearch($search = '')
    {
        return $this->db->query("SELECT * FROM story WHERE title LIKE '%".$search."%'")->results();
    }

    public function getTagsArrayOfStory(array $tags)
    {
        $tagsArray = array();
        foreach ($tags as $tag) {
           $tagsArray[] = $tag->id;
        }

        return $tagsArray;
    }
}