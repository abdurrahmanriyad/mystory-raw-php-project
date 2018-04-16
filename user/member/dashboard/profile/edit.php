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
    use \Classes\Util\Token;
    use \Classes\Member\Profession;
    use \Classes\Validation\Validation;
    use \Classes\Member\Member;
    use \Classes\Member\MembershipService;
?>

<?php require_once "../../../views/includes/header.php" ?>

<?php

    $objProfession = new Profession();
    $professions = $objProfession->getProfessions();

    if (Input::exists()) {
        if (Token::check(Input::get('token'))) {

            $objValidation = new Validation();
            $objValidation->validate($_POST,
                array(
                    'name' => array(
                        'required' => true,
                        'min' => 5
                    ),
                    'dateofbirth' => array(
                        'required' => true,
                        'min' => 5,
                    ),
                    'profession_id' => array(
                        'required' => true
                    )
                )
            );

            if ($objValidation->passed()) {
                $objMember = new Member();
                $objMemberShipService = new MembershipService();

                $objMember->name = Input::get('name');
                $objMember->setDateOfBirth(Input::get('dateofbirth'));
                $objMember->profession = Input::get('profession_id');
                $objMember->photo_url = $member->photo_url;
                $objMember->new_photo_url = Input::file('photo_url');

                $objMemberShipService->updateMember($objMember, $member->id);

                $professions = $objProfession->getProfessions();
                $member = $objMemberRepository->get(\Classes\Util\Session::get('user'));

            } else {
                print_r($objValidation->errors());
            }
        }
    }

?>


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
                <li><a href="<?php echo base_url("user/member/dashboard/profile") ?>"><button class="btn btn-success"><i class="fa fa-backward"></i> &nbsp; Back</button></a></li>
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
                                <div class="form-group">
                                    <label for="name" class="control-label">Name : </label>
                                    <input class="form-control" placeholder="Enter Title" name="name" type="text" id="name" value="<?php echo $member->name; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="datepicker">Date Of Birth:</label>

                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control pull-right" id="datepicker" type="text" data-date-format="yyyy-mm-dd" name="dateofbirth" value="<?php echo $member->dateofbirth; ?>">
                                    </div>
                                    <!-- /.input group -->
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
                                    <label for="photo_url" class="control-label">Profile Picture : (900 x 500)</label>
                                    <input name="photo_url" type="file" id="photo_url">
                                </div>

                                <div class="form-group">
                                    <label for="profession_id" class="control-label">Profession : </label>
                                    <select class="form-control" id="profession_id" name="profession_id">
                                        <?php foreach ($professions as $profession) : ?>
                                            <?php if ($profession->id == $member->profession_id) : ?>
                                                <option value="<?php echo $profession->id ?>" selected> <?php echo $profession->title ?> </option>
                                            <?php else : ?>
                                                <option value="<?php echo $profession->id ?>"> <?php echo $profession->title ?> </option>
                                                <?php endif; ?>
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