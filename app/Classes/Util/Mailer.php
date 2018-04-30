<?php
/**
 * Created by PhpStorm.
 * User: primez
 * Date: 4/30/18
 * Time: 8:31 PM
 */

namespace Classes\Util;


class Mailer
{
    private $to;
    private $subject;
    private $message;
    private $headers;

    /**
     * @param mixed $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setMailHeader($email)
    {
        $this->headers .= "From: ".$email.'\r\n';
    }

    public function setCcHeader($cc)
    {
        $this->headers .= "Cc: ".$cc.'\r\n';
    }

    public function send()
    {
        if (mail($this->to, $this->subject, $this->message, $this->headers)) {
            return true;
        }

        return false;
    }

//$headers  = "From: testsite < mail@testsite.com >\n";
//$headers .= "Cc: testsite < mail@testsite.com >\n";
//$headers .= "X-Sender: testsite < mail@testsite.com >\n";
//$headers .= 'X-Mailer: PHP/' . phpversion();
//$headers .= "X-Priority: 1\n"; // Urgent message!
//$headers .= "Return-Path: mail@testsite.com\n"; // Return path for errors
//$headers .= "MIME-Version: 1.0\r\n";
//$headers .= "Content-Type: text/html; charset=iso-8859-1\n";
}