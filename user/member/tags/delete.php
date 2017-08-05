<?php

    require_once "../../../vendor/autoload.php";

    use \Classes\Story\Tag;
    use \Classes\Session\Session;
    use \Classes\ErrorMessage\ErrorMessage;

    $error_message = new ErrorMessage();
    $tag = new Tag();
    $session = new Session();

    if (isset($_GET['id'])) {

        if ($tag->removeTag($_GET['id']) ) {
            $session->set("session_message", $error_message->getSuccessMessage("Successfully Deleted!"));
        } else {
            $session->set("session_message", $error_message->getAlertMessage("Failed to delete"));
        }

    }

    redirect(base_url("user/member/tags"));

