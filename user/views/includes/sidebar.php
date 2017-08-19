<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="
                <?php echo empty($member->photo_url) ?
                    base_url('user/dist/img/'.\Classes\Config\Config::get('defaults/profile_pic')) :
                    base_url('user/uploads/'.$member->photo_url);
                ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $member->name; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->

        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <?php include_once "member/sidebar-options.php" ?>

<!--            <li class="treeview">-->
<!--                <a href="#">-->
<!--                    <i class="fa fa-pie-chart"></i>-->
<!--                    <span>Blog</span>-->
<!--            <span class="pull-right-container">-->
<!--              <i class="fa fa-angle-left pull-right"></i>-->
<!--            </span>-->
<!--                </a>-->
<!--                <ul class="treeview-menu">-->
<!--                    <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> Posts </a></li>-->
<!--                    <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Categories</a></li>-->
<!--                    <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Tags</a></li>-->
<!--                </ul>-->
<!--            </li>-->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>