<?php
/**
 * Created by PhpStorm.
 * User: primez
 * Date: 8/3/17
 * Time: 12:42 PM
 */

namespace Classes\Email;


class  Email
{
    private $sender_email;
    private $subject;
    private $body;

    /**
     * Email constructor.
     * @param $sender_email
     * @param $subject
     * @param $body
     */
    public function __construct($sender_email, $subject, $body)
    {
        $this->sender_email = $sender_email;
        $this->subject = $subject;
        $this->body = $body;
    }


}