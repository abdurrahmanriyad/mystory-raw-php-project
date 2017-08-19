<?php
/**
 * Created by PhpStorm.
 * User: primez
 * Date: 8/3/17
 * Time: 12:35 PM
 */

namespace Classes\Story;


class Comment
{
    private $comment;

    /**
     * Comment constructor.
     * @param $comment
     */
    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    public function getComment()
    {
        return $this->comment;
    }

}