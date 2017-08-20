<?php

    require_once $_SERVER['DOCUMENT_ROOT']."/mystory/vendor/autoload.php";

    use \Classes\Story\CategoryRepository;
    use \Classes\ErrorMessage\ErrorMessage;
    use \Classes\Story\StoryService;
    use \Classes\Member\MembershipService;
    use \Classes\Validation\Input;
    use \Classes\Util\Redirect;


    $objMembershipService = new MembershipService();

    if (Input::exists('get')) {
        $userId = Input::get('id');
        $objMembershipService->deleteStory($userId);
    }

    Redirect::to(base_url("user/admin/dashboard/stories"));

