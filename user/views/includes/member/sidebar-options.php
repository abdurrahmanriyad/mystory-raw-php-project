<?php require_once "../../../vendor/autoload.php"; ?>

<li class="treeview">
    <a href="#">
        <i class="fa fa-pie-chart"></i>
        <span>Profile</span>
<span class="pull-right-container">
  <i class="fa fa-angle-left pull-right"></i>
</span>
    </a>
    <ul class="treeview-menu">
        <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> Profile </a></li>
        <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Portfolios</a></li>
        <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Gallery</a></li>
        <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Quotes</a></li>
        <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Social</a></li>
    </ul>
</li>


<li class="treeview">
    <a href="#">
        <i class="fa fa-pie-chart"></i>
        <span>Story</span>
<span class="pull-right-container">
  <i class="fa fa-angle-left pull-right"></i>
</span>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo base_url('user/member/stories/')  ?>"><i class="fa fa-circle-o"></i> Stories</a></li>
        <li><a href="<?php echo base_url('user/member/stories/create.php')  ?>"><i class="fa fa-circle-o"></i> Create </a></li>
    </ul>
</li>


<li class="treeview">
    <a href="#">
        <i class="fa fa-pie-chart"></i>
        <span>Category</span>
<span class="pull-right-container">
  <i class="fa fa-angle-left pull-right"></i>
</span>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo base_url('user/member/categories'); ?>"><i class="fa fa-circle-o"></i> Categories </a></li>
        <li><a href="<?php echo base_url('user/member/categories/create.php'); ?>"><i class="fa fa-circle-o"></i> Create</a></li>
    </ul>
</li>


<li class="treeview">
    <a href="#">
        <i class="fa fa-pie-chart"></i>
        <span>Tag</span>
<span class="pull-right-container">
  <i class="fa fa-angle-left pull-right"></i>
</span>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo base_url('user/member/tags'); ?>"><i class="fa fa-circle-o"></i> Tags </a></li>
        <li><a href="<?php echo base_url('user/member/tags/create.php'); ?>"><i class="fa fa-circle-o"></i> Create</a></li>
    </ul>
</li>