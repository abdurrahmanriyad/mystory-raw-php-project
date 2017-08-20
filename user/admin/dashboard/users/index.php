<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/mystory/vendor/autoload.php";

    use \Classes\Story\StoryService;
    use \Classes\Story\StoryRepository;
    use \Classes\Member\Member;
    use \Classes\Member\MemberRepository;
    use \Classes\Member\MembershipService;
    use \Classes\Story\Story;
    use \Classes\Util\Session;
    use \Classes\Validation\Input;

    $objSession = new Session();
    $objStoryService = new StoryService();
    $objMembershipService = new MembershipService();


    if (Input::exists()) {
        if (Input::issetInput('check')) {
            $memberId = Input::get('member_id');
            $objMembershipService->updateMemberActivation(1,$memberId);
        }

        if (Input::issetInput('cross')) {
            $memberId = Input::get('member_id');
            $objMembershipService->updateMemberActivation(0,$memberId);
        }

        if (Input::issetInput('change_role')) {
            $input_count = Input::get('input_count');
            $user_id = Input::get('user_id');
            $user_group = Input::get('user_group'.$input_count);

            $objMembershipService->updateMemberPermission($user_group, $user_id);
        }
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

                            <?php

                                $session_message = $objSession->get('session_message');

                                if (isset($session_message)) {
                                    echo $session_message;
                                    $objSession->unsetSession('session_message');
                                }
                            ?>

                            <table id="data_table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Active</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                    $objMemberRepository = new MemberRepository();
                                    $members = $objMemberRepository->getAllMembers();

                                    if($members) :
                                            $groups = $objMemberRepository->getAllPermissionGroups();
                                            $count = 1;
                                        foreach ($members as $single_member) :
                                            $checkDisabled = $crossDisabled = '';
                                            $single_member->active == 1 ? $checkDisabled = 'disabled' : $crossDisabled = 'disabled';
                                ?>

                                <tr>
                                    <td> <?php echo $count++; ?> </td>
                                    <td> <?php echo $single_member->name; ?>  </td>
                                    <td> <?php echo $single_member->active; ?>  </td>
                                    <td>
                                        <form action="" method="post">
                                            <div class="form-group">
                                                <?php
                                                if ($groups) :
                                                    $permission_checked = "";
                                                    foreach ($groups as $group):
                                                        $single_member->group_id === $group->id ? $permission_checked = "checked" : $permission_checked = "";
                                                        ?>

                                                        <div class="radio">
                                                            <label>
                                                                <input type="hidden" name="input_count" value="<?php echo $count ?>">
                                                                <input type="hidden" name="user_id" value="<?php echo $single_member->id; ?>">
                                                                <input name="user_group<?php echo $count; ?>"  value="<?php echo $group->id ?>" <?php echo $permission_checked; ?> type="radio">
                                                                <?php echo $group->name; ?>
                                                            </label>
                                                        </div>

                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>

                                                <button class="btn btn-sm btn-success" type="submit" name="change_role">Change Role</button>
                                            </div>
                                        </form>
                                    </td>
                                    <td>

                                        <div class="btn-group">

                                            <form style="display: inline-block" action="" method="POST">
                                                <input type="hidden" name="member_id" value="<?php echo $single_member->id ?>">
                                                <button class="btn btn-sm btn-success" title="Approve story" type="submit" <?php echo $checkDisabled ?> name="check"><i class="fa fa-check"></i></button>
                                            </form>

                                            <form style="display: inline-block" action="" method="POST">
                                                <input type="hidden" name="member_id" value="<?php echo $single_member->id ?>">
                                                <button class="btn btn-sm btn-danger" title="Reject story" type="submit" <?php echo $crossDisabled ?> name="cross"><i class="fa fa-times"></i></button>
                                            </form>

<!--                                            <form style="display: inline-block;" action="--><?php //echo base_url("user/admin/dashboard/users/delete.php?id=".$single_member->id) ?><!--" method="POST">-->
<!--                                                <input type="hidden" name="member_id" value="--><?php //echo $single_member->id ?><!--">-->
<!--                                                <button class="btn btn-sm btn-default" title="Delete story" type="submit" name="delete"><i class="fa fa-trash-o"></i></button>-->
<!--                                            </form>-->




                                        </div>


                                    </td>
                                </tr>

                                <?php
                                        endforeach;

                                    endif;
                                ?>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Active</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>

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