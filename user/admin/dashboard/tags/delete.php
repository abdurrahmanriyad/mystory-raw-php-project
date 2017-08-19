<?php

    require_once $_SERVER['DOCUMENT_ROOT']."/mystory/vendor/autoload.php";

    use \Classes\Story\TagRepository;
    use \Classes\Validation\Input;
    use \Classes\Util\Redirect;

    if (Input::exists()) {
        $objTagRepository = new TagRepository();
        $id = Input::get('id');

        $objTagRepository->removeTag($id);
    }

    Redirect::to(base_url("user/member/dashboard/tags"));

