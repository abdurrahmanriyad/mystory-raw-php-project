<?php
    require_once "vendor/autoload.php";
    use \Classes\Config\Config;
    use \Classes\Util\Session;
    use \Classes\Member\MembershipService;
    use \Classes\Story\StoryRepository;
    use \Classes\Validation\Input;
    use \Classes\Story\Story;
?>

<?php  require_once "views/includes/header.php" ?>
<?php
    $objMembershipService = new MembershipService();
    $objStory = new Story();
?>
<div class="content_area">
    <div class="container">
        <div class="row">
            <div class="col m9">
                <div class="content">
                    <div class="story_block">
                        <?php
                            $objStoryRepository = new StoryRepository();

                            if (Input::exists('get')) {
                                $category = Input::get('category');
                            }
                            $stories = $objStoryRepository->getStoriesByCategory($category);

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
                                <div class="col s4">
                                    <div class="comments">
                                        <i class="fa fa-comments"></i> <?php echo $objStory->countComments($story->id); ?>
                                    </div>
                                </div>
                                <div class="col s4">
                                    <ul class="rating">
                                        <li class="fill"> <i class="fa fa-star"></i></li>
                                        <li class="fill"> <i class="fa fa-star"></i></li>
                                        <li class="fill"> <i class="fa fa-star"></i></li>
                                        <li class="fill"> <i class="fa fa-star-o"></i></li>
                                        <li class="fill"> <i class="fa fa-star-o"></i></li>
                                    </ul>
                                </div>
                                <div class="col s4">
                                    <div class="like">
                                        <span class="upvote"><i class="fa fa-thumbs-up"></i> 14</span>
                                        <span class="downvote"><i class="fa fa-thumbs-down"></i> 2</span>
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