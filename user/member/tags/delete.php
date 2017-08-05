<?php

    require_once "../../../vendor/autoload.php";

    use \Classes\Story\Category;
    use \Classes\Session\Session;
    use \Classes\ErrorMessage\ErrorMessage;

    $error_message = new ErrorMessage();
    $category = new Category();
    $session = new Session();

    if (isset($_GET['id'])) {

        if ($category->removeCategory($_GET['id']) ) {
            $session->set("session_message", $error_message->getSuccessMessage("Successfully Deleted!"));
        } else {
            $session->set("session_message", $error_message->getAlertMessage("Failed to delete"));
        }

    }

    redirect(base_url("user/member/categories"));

