<?php

    require_once $_SERVER['DOCUMENT_ROOT']."/mystory/vendor/autoload.php";

    use \Classes\Member\MembershipService;
    use \Classes\Member\MemberRepository;
    use \Classes\Story\Story;
    use \Classes\Util\Session;

    $objMembershipService = new MembershipService();
    $objMemberRepository = new MemberRepository();

    $member = $objMemberRepository->get(\Classes\Util\Session::get('user'));

    if (!$objMembershipService->isLoggedIn()) {

    }


?>

<?php require_once "../../../views/includes/header.php" ?>
<?php require_once "../../../views/includes/sidebar.php" ?>



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

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <!--form begin-->
                <div class="col-md-12">
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="box">
                        <div class="box-body">

                            <div class="profile_area">
                                <div class="profile_thumbnail">
                                    <img src="
                                    <?php echo empty($member->photo_url) ?
                                        base_url('user/dist/img/'.\Classes\Config\Config::get('defaults/profile_pic')) :
                                        base_url('user/uploads/'.$member->photo_url);
                                    ?>" alt="" class="img-circle">
                                </div>

                                <table id="data_table" class="table table-bordered table-striped">
                                    <thead>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <td><?php echo $member->name; ?></td>
                                        </tr>

                                        <tr>
                                            <th>Username</th>
                                            <td><?php echo $member->username; ?></td>
                                        </tr>

                                        <tr>
                                            <th>Email</th>
                                            <td><?php echo $member->email; ?></td>
                                        </tr>

                                        <tr>
                                            <th>Profession</th>
                                            <td><?php echo $member->profession_id; ?></td>
                                        </tr>

                                        <tr>
                                            <th>Date of Birth</th>
                                            <td><?php echo $member->dateofbirth; ?></td>
                                        </tr>

                                        <tr>
                                            <th>Member since</th>
                                            <td><?php echo $member->created_at; ?></td>
                                        </tr>





                                    </tbody>
                                </table>

                            </div>

                            <!--data table finished-->

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<?php require_once "../../../views/includes/footer.php" ?>