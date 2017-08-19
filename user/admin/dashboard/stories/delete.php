<?php

    require_once $_SERVER['DOCUMENT_ROOT']."/mystory/vendor/autoload.php";

    use \Classes\Story\CategoryRepository;
    use \Classes\ErrorMessage\ErrorMessage;
    use \Classes\Story\StoryService;
    use \Classes\Validation\Input;
    use \Classes\Util\Redirect;


    $objectStoryService = new StoryService();
    $objErrMessage = new ErrorMessage();
    $objCategoryRepository = new CategoryRepository();

    if (Input::exists('get')) {
        $storyId = Input::get('id');
        $objectStoryService->deleteStory($storyId);
    }

    Redirect::to(base_url("user/admin/dashboard/stories"));

