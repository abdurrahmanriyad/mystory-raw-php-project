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
                <div class="content">
                    <div class="story_block">
                        <?php
                            $objStoryRepository = new StoryRepository();
                            $stories = $objStoryRepository->getAllStories();
                        ?>


                        <?php
                            if ($stories) :
                                foreach ($stories as $story) :
                        ?>
                        <div class="card">
                            <div class="card-image">
                                <img src="<?php echo base_url('uploads/'.$story->featured_image) ?>">
                                <span class="card-title author">by <span>Riyad Uddin</span></span>
                            </div>
                            <div class="card-content">
                                <h4 class="card-title"><strong><a href="<?php echo 'single-story.php?id='.$story->id ?>"><?php echo $story->title; ?></a></strong></h4>
                                <div><?php echo string_limit($story->body); ?></div>
                            </div>

                            <div class="card-action">
                                <div class="col s6">
                                    <div class="comments">
                                        <i class="fa fa-comments"></i> <?php echo $objStory->countComments($story->id); ?>
                                    </div>
                                </div>
                                <div class="col s6">
                                    <div class="like <?php
                                    if($member) {
                                        if ($objStoryService->countStoryLikeByUser($story->id, Session::get('user'))) {
                                            echo ' liked';
                                        }
                                    } ?>">
                                        <span class="upvote">
                                            <button data-storyId="<?php echo $story->id; ?>" data-userId="<?php echo Session::get('user'); ?>">
                                                <i class="fa fa-thumbs-up"></i>
                                            </button>
                                            <span class="likeCount"><?php echo $objStoryService->countStoryLikes($story->id); ?></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                                endforeach;
                            endif
                        ?>

                    </div>
                </div>
            </div>

            <div class="col m3">
                <?php include_once 'views/includes/sidebar.php' ?>
            </div>
        </div>
    </div>
</div>

<?php require_once "views/includes/footer.php" ?>