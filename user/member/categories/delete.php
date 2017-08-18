<?php

    require_once "../../../vendor/autoload.php";

    use \Classes\Story\CategoryRepository;
    use \Classes\ErrorMessage\ErrorMessage;
    use \Classes\Validation\Input;
    use \Classes\Util\Redirect;

    $objErrMessage = new ErrorMessage();
    $objCategoryRepository = new CategoryRepository();


    if (Input::exists()) {
        $objCategoryRepository->removeCategory(Input::get('id'));
    }

    Redirect::to(base_url("user/member/categories"));

