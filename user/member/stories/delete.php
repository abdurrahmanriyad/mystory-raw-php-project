<?php

    require_once "../../../vendor/autoload.php";

    use \Classes\Story\CategoryRepository;
    use \Classes\ErrorMessage\ErrorMessage;
    use \Classes\Story\StoryService;
    use \Classes\Validation\Input;


    $objectStoryService = new StoryService();
    $objErrMessage = new ErrorMessage();
    $objCategoryRepository = new CategoryRepository();

    if (Input::exists('get')) {
        $storyId = Input::get('id');
        $objectStoryService->deleteStory($storyId);
    }

    redirect(base_url("user/member/stories"));

