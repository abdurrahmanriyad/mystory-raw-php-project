<?php

    require_once $_SERVER['DOCUMENT_ROOT']."/mystory/vendor/autoload.php";

    use \Classes\Story\TagRepository;
    use \Classes\Util\Session;

    $objSession = new Session();

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

            <ul class="list-inline">
                <li><a href="<?php echo base_url("user/member/dashboard/tags/create.php") ?>"><button class="btn btn-success"><i class="fa fa-plus"></i> &nbsp New Tag</button></a></li>
            </ul>

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
                                    <th>Title</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                    $objTagRepository = new TagRepository();
                                    $tags = $objTagRepository->getTags();

                                    if($tags) :
                                        $count = 1;
                                        foreach ($tags as $single_tag) :
                                ?>

                                <tr>
                                    <td> <?php echo $count++; ?> </td>
                                    <td> <?php echo $single_tag->tag; ?>  </td>
                                    <td> <?php echo $single_tag->created_at; ?> </td>
                                    <td>

                                        <div class="btn-group">
                                            <a class="btn btn-primary btn-sm" href="<?php echo base_url("user/member/dashboard/tags/edit.php?id=".$single_tag->id) ?>"><i class="fa fa-pencil-square-o"></i></a>

                                            <form style="display: inline-block" action="<?php echo base_url("user/member/dashboard/tags/delete.php?id=".$single_tag->id) ?>" method="POST">
                                                <button class="btn btn-sm btn-default" type="submit" name="delete"><i class="fa fa-trash-o"></i></button>
                                            </form>
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
                                    <th>Title</th>
                                    <th>Action</th>
                                    <th>Created at</th>
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