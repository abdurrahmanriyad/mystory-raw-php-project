<?php

namespace Classes\Story;

use Classes\Database\DB;
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
    private $db;
    private $objStory;
    private $objStoryRepository;

    public function __construct()
    {
        $this->objValidation = new Validation();
        $this->objFormFile = new FormFile();
        $this->db = DB::getInstance();
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

    public function countStoryLikes($storyId)
    {
        return $this->db->get('story_like', ['story_id', '=', $storyId])->count();
    }

    public function countCommentLikes($storyId, $commentId)
    {
        return $this->db->query('SELECT * FROM comment_like WHERE story_id ='.$storyId.' AND comment_id = '.$commentId)->count();
    }

    public function countReplyLikes($storyId, $commentId, $replyId)
    {
        return $this->db->query('SELECT * FROM reply_like WHERE story_id ='.$storyId.' AND comment_id = '.$commentId.' AND reply_id = '.$replyId)->count();
    }


    public function countStoryLikeByUser($storyId, $userId)
    {
        return $this->db->query('SELECT * FROM story_like WHERE story_id ='.$storyId.' AND user_id = '.$userId)->count();

    }

    public function countCommentLikeByUser($storyId, $userId, $commentId)
    {
        return $this->db->query('SELECT * FROM comment_like WHERE story_id ='.$storyId.' AND user_id = '.$userId. ' AND comment_id = '.$commentId )->count();
    }

    public function countReplyLikeByUser($storyId, $userId, $commentId, $replyId)
    {
        return $this->db->query('SELECT * FROM reply_like WHERE story_id ='.$storyId.' AND user_id = '.$userId. ' AND comment_id = '.$commentId.' AND reply_id = '.$replyId )->count();
    }

    public function removeStoryLikeOfUser($storyId, $userId)
    {
        return $this->db->query('DELETE FROM story_like WHERE story_id = '.$storyId. ' AND user_id = '.$userId);
    }

    public function removeCommentLikeOfUser($storyId, $userId, $commentId)
    {
        return $this->db->query('DELETE FROM comment_like WHERE story_id = '.$storyId. ' AND user_id = '.$userId.' AND comment_id = '.$commentId);
    }

    public function removeReplyLikeOfUser($storyId, $userId, $commentId, $replyId)
    {
        return $this->db->query('DELETE FROM reply_like WHERE story_id = '.$storyId. ' AND user_id = '.$userId.' AND comment_id = '.$commentId.' AND reply_id = '.$replyId);
    }





    public function likeStory($storyId, $userId)
    {
        return $this->db->insert('story_like', [
            'liked' => 1,
            'user_id' => $userId,
            'story_id' => $storyId,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s')
        ]);
    }


    public function likeComment($storyId, $userId, $commentId)
    {
        return $this->db->insert('comment_like', [
            'liked' => 1,
            'user_id' => $userId,
            'story_id' => $storyId,
            'comment_id' => $commentId,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s')
        ]);
    }


    public function likeReply($storyId, $userId, $commentId, $replyId)
    {
        return $this->db->insert('reply_like', [
            'liked' => 1,
            'user_id' => $userId,
            'story_id' => $storyId,
            'comment_id' => $commentId,
            'reply_id' => $replyId,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s')
        ]);
    }


}