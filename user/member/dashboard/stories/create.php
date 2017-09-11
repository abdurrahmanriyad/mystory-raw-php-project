<?php require_once $_SERVER['DOCUMENT_ROOT']."/mystory/vendor/autoload.php"; ?>
<?php
    use \Classes\Story\Tag;
    use \Classes\Story\TagRepository;
    use \Classes\Story\Category;
    use \Classes\Story\CategoryRepository;
    use \Classes\Story\Story;
    use \Classes\Story\StoryRepository;
    use \Classes\Story\StoryService;
    use \Classes\ErrorMessage\ErrorMessage;
    use \Classes\Validation\Input;
    use \Classes\Member\Member;
    use \Classes\Member\MembershipService;
    use \Classes\Validation\Validation;
    use \Classes\Util\Token;
    use \Classes\Util\Session;
    use \Classes\Util\Redirect;
?>
<?php

    $objTagRepository = new TagRepository();
    $objCategoryRepository = new CategoryRepository();

    $tags = $objTagRepository->getTags();
    $categories = $objCategoryRepository->getCategories();
    $objErrMessage = new ErrorMessage();
    $message = "";



    if (Input::exists()) {
        if (Token::check(Input::get('token'))) {

            $objValidation = new Validation();
            $objValidation->validate($_POST,
                array(
                    'title' => array(
                        'required' => true,
                        'min' => 5
                    ),
                    'body' => array(
                        'required' => true,
                        'min' => 5,
                    ),
                    'category_id' => array(
                        'required' => true
                    )
                )
            );

            if ($objValidation->passed()) {

                $objStory = new Story();
                $objStoryService = new StoryService();

                $objStory->title = Input::get('title');
                $objStory->body  = Input::get('body');
                $objStory->category_id  = Input::get('category_id');
                $objStory->featured_image = Input::file('featured_image');

                $inputTag = Input::get('tags');

                isset($inputTag) ? $objStory->tags = $inputTag : $objStory->tags = [''];

                $inserted_id = $objStoryService->submitStory($objStory);

                if(!$inserted_id) {
                    $message = $objErrMessage->getAlertMessage("failed to create story!");
                } else {
                    $message = $objErrMessage->getSuccessMessage("Successfully created story!");
                }


            } else {
                print_r($objValidation->errors());
            }


        }
    }
?>


<?php require_once "../../../views/includes/header.php" ?>
<?php require_once "../../../views/includes/sidebar.php" ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Version 2.0</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <ul class="list-inline text-left">
                <li><a href="<?php echo base_url('user/member/dashboard/stories/') ?>"><button class="btn btn-success"><i class="fa fa-backward"></i> &nbsp; Back</button></a></li>
            </ul>
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <!--form begin-->

                <form action="" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">

                    <div class="col-md-9">
                        <!-- TABLE: LATEST ORDERS -->
                        <div class="box">
                            <div class="box-body">
                                <?php echo $message; ?>
                                <div class="form-group">
                                    <label for="title" class="control-label">Title : </label>
                                    <input class="form-control" placeholder="Enter Title" name="title" type="text" id="title">
                                </div>

                                <div class="form-group">
                                    <label for="title" class="control-label">Body : </label>
                                    <textarea class="form-control" name="body" id="post_desc" placeholder="Enter post contents" rows="15"></textarea>
                                </div>

                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->

                    <div class="col-md-3">

                        <!-- PRODUCT LIST -->
                        <div class="box box-primary">
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="featured_image" class="control-label">Thumbnail : (900 x 500)</label>
                                    <input name="featured_image" type="file" id="featured_image">
                                </div>

                                <div class="form-group">
                                    <label for="category_id" class="control-label">Category : </label>
                                    <select class="form-control" id="category_id" name="category_id">
                                        <?php foreach ($categories as $single_category) : ?>
                                            <option value="<?php echo $single_category->id ?>"> <?php echo $single_category->category ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>




                                <div class="form-group">
                                    <label for="tag_id" class="control-label">Tags : </label>
                                    <select name="tags[]" multiple class="form-control select2" id="tag_id">
                                        <?php foreach ($tags as $single_tag) : ?>
                                            <option value="<?php echo $single_tag->id ?>"> <?php echo $single_tag->tag ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>



                                <div class="box-footer text-right">
                                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                    <input class="btn btn-primary btn-md btn-block" name="submit" type="submit" value="Save">
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->

                </form>

            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


<?php require_once "../../../views/includes/footer.php" ?>