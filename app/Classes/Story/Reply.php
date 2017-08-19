<?php
/**
 * Created by PhpStorm.
 * User: primez
 * Date: 8/19/17
 * Time: 5:19 PM
 */

namespace Classes\Story;


class Reply
{
    private $reply;

    /**
     * Reply constructor.
     * @param $reply
     */
    public function __construct($reply)
    {
        $this->reply = $reply;
    }

    /**
     * @return mixed
     */
    public function getReply()
    {
        return $this->reply;
    }



}