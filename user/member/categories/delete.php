<?php

    require_once "../../../vendor/autoload.php";

    use \Classes\Story\CategoryRepository;
    use \Classes\Session\Session;
    use \Classes\ErrorMessage\ErrorMessage;

    $objErrMessage = new ErrorMessage();
    $objCategoryRepository = new CategoryRepository();
    $session = new Session();

    if (isset($_GET['id'])) {

        if ($objCategoryRepository->removeCategory($_GET['id']) ) {
            $session->set("session_message", $objErrMessage->getSuccessMessage("Successfully Deleted!"));
        } else {
            $session->set("session_message", $objErrMessage->getAlertMessage("Failed to delete"));
        }

    }

    redirect(base_url("user/member/categories"));

