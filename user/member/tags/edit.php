<?php require_once "../../../vendor/autoload.php"; ?>

<?php
    use \Classes\Story\TagRepository;
    use \Classes\ErrorMessage\ErrorMessage;
    $objTagRepository = new TagRepository();
?>

<?php

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['id']) ) {
            $id = $_GET['id'];
            $single_tag = $objTagRepository->getTagById($id);
        }
    }



    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_POST['submit'])) {

            $errMessage = new ErrorMessage();
            $edit_tag = $_POST['tag'];
            $tag_id = $_POST['id'];

            if ($objTagRepository->editTag($tag_id, $edit_tag)) {
                $objErrMessage = new ErrorMessage();
                $message = $objErrMessage->getSuccessMessage("Successfully Updated!");
                $single_tag = $objTagRepository->getTagById($tag_id);
            } else {
                $message = $objErrMessage->getAlertMessage("Failed to create updated");
            }

        }

    }


?>


<?php require_once "../../views/includes/header.php" ?>
<?php require_once "../../views/includes/sidebar.php" ?>
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

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <!--form begin-->
                <form role="form" method="POST" action="">

                    <div class="col-md-9">
                        <!-- TABLE: LATEST ORDERS -->
                        <div class="box">
                            <div class="box-body">

                                <?php global $message; echo $message; ?>

                                <div class="form-group">
                                    <label for="category_title">Title</label>
                                    <input type="hidden" name="id" value="<?php echo $single_tag[0]->id ?>">
                                    <input type="text" class="form-control" id="category_title" value="<?php echo $single_tag[0]->tag; ?>" placeholder="Enter Title" name="tag">
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
                                <div class="box-footer text-right">
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
<?php require_once "../../views/includes/footer.php" ?>