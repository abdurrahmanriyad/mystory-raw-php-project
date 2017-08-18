<?php require_once "../../../vendor/autoload.php"; ?>

<?php
    use \Classes\Story\Category;
    use \Classes\Story\CategoryRepository;
    use \Classes\ErrorMessage\ErrorMessage;
    use \Classes\Validation\Input;

    $objCategoryRepository = new CategoryRepository();
?>

<?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['id']) ) {
            $id = $_GET['id'];
            $single_category = $objCategoryRepository->getCategoryById($id);
        }
    }



    if (Input::exists()) {
        $objCategory = new Category();
        $objCategory->id = Input::get('id');
        $objCategory->title = Input::get('category');


        if ($objCategoryRepository->editCategory($objCategory)) {

            $objErrMessage = new ErrorMessage();
            $message = $objErrMessage->getSuccessMessage("Successfully updated!");
            $single_category = $objCategoryRepository->getCategoryById($objCategory->id);

        } else {
            $message = $objErrMessage->getAlertMessage("Failed to update category");
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
                                <?php global $message; echo $message;?>

                                <div class="form-group">
                                    <label for="category_title">Title</label>
                                    <input type="hidden" name="id" value="<?php echo $single_category[0]->id ?>">
                                    <input type="text" class="form-control" id="category_title" value="<?php echo $single_category[0]->category; ?>" placeholder="Enter Title" name="category">
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