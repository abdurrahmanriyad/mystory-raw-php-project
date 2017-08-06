<?php

    require_once "../../../vendor/autoload.php";

    use \Classes\Story\Tag;
    use \Classes\Story\TagRepository;
    use \Classes\Session\Session;
    use \Classes\ErrorMessage\ErrorMessage;

    $objError_message = new ErrorMessage();
    $objTagRepository = new TagRepository();
    $objSession = new Session();

    if (isset($_GET['id'])) {

        $objTag = new Tag();
        $objTag->id = $_GET['id'];

        if ($objTagRepository->removeTag($objTag) ) {
            $objSession->set("session_message", $objError_message->getSuccessMessage("Successfully Deleted!"));
        } else {
            $objSession->set("session_message", $objError_message->getAlertMessage("Failed to delete"));
        }

    }

    redirect(base_url("user/member/tags"));

