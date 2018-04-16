<?php
    require_once "vendor/autoload.php";
    use \Classes\Config\Config;
    use \Classes\Util\Session;
    use \Classes\Story\StoryService;
    use \Classes\Member\MembershipService;
    use \Classes\Story\StoryRepository;
    use \Classes\Story\Story;
?>

<?php  require_once "views/includes/header.php" ?>
<?php
    $objMembershipService = new MembershipService();
    $objStory = new Story();
    $objStoryService = new StoryService();
?>
<div class="content_area">
    <div class="container">
        <div class="row">
            <div class="col m9">
                <!-- change here-->
            </div>

            <div class="col m3">
                <?php include_once 'views/includes/sidebar.php' ?>
            </div>
        </div>
    </div>
</div>

<?php require_once "views/includes/footer.php" ?>