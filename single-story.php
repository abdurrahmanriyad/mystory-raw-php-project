<?php
    require_once "vendor/autoload.php";
    use \Classes\Validation\Input;
    use \Classes\Story\StoryRepository;
?>


<?php  require_once "views/includes/header.php" ?>

<div class="content_area">
    <div class="container">
        <div class="row">
            <div class="col m9">
                <div class="content">
                    <div class="story_block">
                        <?php
                            if (Input::exists('get')) {
                                $id = Input::get('id');

                                $objStoryRepository = new StoryRepository();
                                $story = $objStoryRepository->get($id);
                            }
                        ?>

                        <div class="card">
                            <div class="card-image">
                                <img src="<?php echo base_url('uploads/'.$story->featured_image) ?>">
                                <span class="card-title author">by <span>Abdur Rahman</span></span>
                            </div>
                            <div class="card-content">
                                <h4 class="card-title"><strong><?php echo $story->title; ?></strong></h4>
                                <div>
                                    <?php echo $story->body; ?>
                                </div>
                            </div>
                            <div class="card-action">
                                <div class="col s4">
                                    <div class="comments">
                                        <i class="fa fa-comments"></i> 36
                                    </div>
                                </div>
                                <div class="col s4">
                                    <ul class="rating">
                                        <li class="fill"> <i class="fa fa-star-o"></i></li>
                                        <li class="fill"> <i class="fa fa-star-o"></i></li>
                                        <li class="fill"> <i class="fa fa-star-o"></i></li>
                                        <li class="fill"> <i class="fa fa-star-o"></i></li>
                                        <li class="fill"> <i class="fa fa-star-o"></i></li>
                                    </ul>
                                </div>
                                <div class="col s4">
                                    <div class="like">
                                        <span class="upvote"><i class="fa fa-thumbs-up"></i> 35</span>
                                        <span class="downvote"><i class="fa fa-thumbs-down"></i> 35</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!--answer area begin-->
                    <div class="answer_area"> <!-- answer area begin -->
                        <div class="post_an_answer clearfix">
                            <form class="col s12">

                                <div class="row">
                                    <div class="input-field col s12">
                                        <textarea id="textarea1" class="materialize-textarea"></textarea>
                                        <label for="textarea1">Post a reply</label>
                                    </div>
                                    <div class="input-field col s12 right-align">
                                        <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                                            <i class="fa fa-message"></i>
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <div class="answers">
                            <div class="single_answer">
                                <div class="single_answer_content">
                                    <div class="single_answer_text">
                                        <div class="userinfo">
                                            <div class="avatar">
                                                <img src="assets/img/user.jpg" alt="" class="img-circle">
                                            </div>
                                        </div>
                                        <div class="posttext">
                                            <p>I have never seen a website as helpful as this one. I am very <em>lucky</em> being a developer of this awesome website
                                                I personally thank mr.x for asking this question .
                                            </p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="question_info_bottom center-align">
                                        <ul>
                                            <li><a href="#"> <i class="fa fa-thumbs-o-up"></i>28</a></li>
                                            <li><a href="#"> <i class="fa fa-thumbs-o-down"></i>30</a></li>
                                            <li><a href="#"> <i class="fa fa-mail-reply"></i></a></li>
                                            <li><a href="#"> <i class="fa fa-clock-o"></i>Posted on : 20 Nov @ 9:30am</a></li>
                                        </ul>
                                    </div>
                                </div>


                                <div class="replies"><!-- replies begin -->

                                    <div class="reply"><!-- single reply begin -->
                                        <div class="single_answer_content">
                                            <div class="single_answer_text">
                                                <div class="userinfo">
                                                    <div class="avatar">
                                                        <img src="assets/img/user.jpg" alt="" class="img-circle">
                                                    </div>
                                                </div>
                                                <div class="posttext">
                                                    <p>I have never seen a website as helpful as this one. I am very <em>lucky</em> being a developer of this awesome website
                                                        I personally thank mr.x for asking this question .
                                                    </p>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>

                                            <div class="question_info_bottom center-align">
                                                <ul>
                                                    <li><a href="#"> <i class="fa fa-thumbs-o-up"></i>28</a></li>
                                                    <li><a href="#"> <i class="fa fa-thumbs-o-down"></i>30</a></li>
                                                    <li><a href="#"> <i class="fa fa-mail-reply"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-clock-o"></i>Posted on : 20 Nov @ 9:30am</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- single reply finish -->


                                    <div class="reply"><!-- single reply begin -->
                                        <div class="single_answer_content">
                                            <div class="single_answer_text">
                                                <div class="userinfo">
                                                    <div class="avatar">
                                                        <img src="assets/img/user.jpg" alt="" class="img-circle">
                                                    </div>
                                                </div>
                                                <div class="posttext">
                                                    <p>I have never seen a website as helpful as this one. I am very <em>lucky</em> being a developer of this awesome website
                                                        I personally thank mr.x for asking this question .
                                                    </p>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>

                                            <div class="question_info_bottom center-align">
                                                <ul>
                                                    <li><a href="#"> <i class="fa fa-thumbs-o-up"></i>28</a></li>
                                                    <li><a href="#"> <i class="fa fa-thumbs-o-down"></i>30</a></li>
                                                    <li><a href="#"> <i class="fa fa-mail-reply"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-clock-o"></i>Posted on : 20 Nov @ 9:30am</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- single reply finish -->

                                    <div class="reply"><!-- single reply begin -->
                                        <div class="single_answer_text">
                                            <div class="post_an_answer clearfix">
                                                <form class="col s12">

                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <textarea id="textarea2" class="materialize-textarea"></textarea>
                                                            <label for="textarea1">Reply to this comment</label>
                                                        </div>
                                                        <div class="input-field col s12 right-align">
                                                            <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                                                                <i class="fa fa-message"></i>
                                                            </button>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- single reply finish -->

                                </div> <!-- replies finished -->
                            </div>
                            <!--single answer finish-->



                            <div class="single_answer">
                                <div class="single_answer_content">
                                    <div class="single_answer_text">
                                        <div class="userinfo">
                                            <div class="avatar">
                                                <img src="assets/img/user.jpg" alt="" class="img-circle">
                                            </div>
                                        </div>
                                        <div class="posttext">
                                            <p>I have never seen a website as helpful as this one. I am very <em>lucky</em> being a developer of this awesome website
                                                I personally thank mr.x for asking this question .
                                            </p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="question_info_bottom center-align">
                                        <ul>
                                            <li><a href="#"> <i class="fa fa-thumbs-o-up"></i>28</a></li>
                                            <li><a href="#"> <i class="fa fa-thumbs-o-down"></i>30</a></li>
                                            <li><a href="#"> <i class="fa fa-mail-reply"></i></a></li>
                                            <li><a href="#"> <i class="fa fa-clock-o"></i>Posted on : 20 Nov @ 9:30am</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="replies"><!-- replies begin -->
                                    <div class="reply"><!-- single reply begin -->
                                        <div class="single_answer_text">
                                            <div class="post_an_answer clearfix">
                                                <form class="col s12">

                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <textarea id="textarea2" class="materialize-textarea"></textarea>
                                                            <label for="textarea1">Reply to this comment</label>
                                                        </div>
                                                        <div class="input-field col s12 right-align">
                                                            <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                                                                <i class="fa fa-message"></i>
                                                            </button>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- single reply finish -->

                                </div> <!-- replies finished -->
                            </div>
                            <!--single answer finish-->


                            <div class="single_answer">
                                <div class="single_answer_content">
                                    <div class="single_answer_text">
                                        <div class="userinfo">
                                            <div class="avatar">
                                                <img src="assets/img/user.jpg" alt="" class="img-circle">
                                            </div>
                                        </div>
                                        <div class="posttext">
                                            <p>I have never seen a website as helpful as this one. I am very <em>lucky</em> being a developer of this awesome website
                                                I personally thank mr.x for asking this question .
                                            </p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="question_info_bottom center-align">
                                        <ul>
                                            <li><a href="#"> <i class="fa fa-thumbs-o-up"></i>28</a></li>
                                            <li><a href="#"> <i class="fa fa-thumbs-o-down"></i>30</a></li>
                                            <li><a href="#"> <i class="fa fa-mail-reply"></i></a></li>
                                            <li><a href="#"> <i class="fa fa-clock-o"></i>Posted on : 20 Nov @ 9:30am</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--single answer finish-->
                        </div>
                        <!--answers finish-->
                    </div> <!-- answer area finished -->
                    <!--answer area finish-->



                </div>
            </div>

            <div class="col m3">
                <?php include_once 'views/includes/sidebar.php' ?>
            </div>
        </div>
    </div>
</div>


<?php require_once "views/includes/footer.php" ?>