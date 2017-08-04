<?php require_once "../../../vendor/autoload.php"; ?>

<?php
    use \Classes\Story\Category;
?>

<?php require_once "../../views/includes/header.php" ?>
<?php require_once "../../views/includes/sidebar.php" ?>



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
                <li><a href="<?php echo base_url("user/member/categories/create.php") ?>"><button class="btn btn-success"><i class="fa fa-plus"></i> &nbsp New Category</button></a></li>
            </ul>

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <!--form begin-->
                <div class="col-md-12">
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="box">
                        <div class="box-body">
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
                                    $category = new Category();
                                    $categories = $category->getCategories();
                                    if($categories) :
                                        $count = 1;
                                        foreach ($categories as $single_category) :
                                ?>
                                <tr>
                                    <td> <?php echo $count++; ?> </td>
                                    <td> <?php echo $single_category->category; ?>  </td>
                                    <td> <?php echo $single_category->created_at; ?> </td>
                                    <td>

<!--                                        {{ Form::open(array('method' => 'delete', 'url' => 'blog/admin/categories/' . $category->id)) }}-->
                                        <div class="btn-group">
                                            <a class="btn btn-primary btn-sm" href="<?php echo base_url("user/member/categories/edit.php?id=".$single_category->id) ?>"><i class="fa fa-pencil-square-o"></i></a>
                                            <button onclick="return confirm('Are you sure ?')" class="btn btn-sm btn-default" type="submit"><i class="fa fa-trash-o"></i></button>
                                        </div>
<!--                                        {{ Form::close() }}-->


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
<?php require_once "../../views/includes/footer.php" ?>