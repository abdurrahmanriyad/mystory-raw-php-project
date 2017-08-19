<?php require_once $_SERVER['DOCUMENT_ROOT']."/mystory/vendor/autoload.php"; ?>
<?php
    use \Classes\Story\Category;
    use \Classes\Story\CategoryRepository;
    use \Classes\ErrorMessage\ErrorMessage;
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_POST['submit'])) {
            $objErrMessage = new ErrorMessage();
            $objCategoryRepository = new CategoryRepository();
            $objCategory = new Category();
            $objCategory->title = $_POST['category'];

            if ($objCategoryRepository->addCategory($objCategory)) {
                $objErrMessage = new ErrorMessage();
                $message = $objErrMessage->getSuccessMessage("Succesfully created!");
            } else {
                $message = $objErrMessage->getAlertMessage("Failed to create category");
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
                                    <input type="text" class="form-control" id="category_title" placeholder="Enter Title" name="category">
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
<?php require_once "../../../views/includes/footer.php" ?>