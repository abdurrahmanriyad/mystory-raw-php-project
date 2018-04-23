<?php
    $objMemberRepository = new \Classes\Member\MemberRepository();
    $member = $objMemberRepository->get(\Classes\Util\Session::get('user'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Story Teller</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Boogaloo">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,500i,700,900">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/css/materialize.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<div class="header_wrapper">
    <div class="overlay"></div>
    <div class="main_menu_area">
        <div class="container">
            <div class="row">
                <div class="col m4">
                    <div class="logo">
                        My story...
                    </div>
                </div>

                <div class="col m8">
                    <ul class="main_nav">
                        <li><a href="./">Home</a></li>

                        <?php
                        $objMembershipService = new \Classes\Member\MembershipService();
                        if ($objMembershipService->isLoggedIn()) : ?>
                            <li><a href="<?php echo base_url('user/member/dashboard/stories/create.php') ?>">Write Your Story</a></li>
                        <?php endif; ?>

                        <li><a href="#">Contact</a></li>
                        <?php
                            $objMembershipService = new \Classes\Member\MembershipService();
                            if ($objMembershipService->isLoggedIn()) :
                        ?>
                                <li class="profile_pic">
                                    <a class='dropdown-button btn' data-beloworigin="true" data-activates='profile_dropdown'>
                                        <img src="
                                        <?php echo empty($member->photo_url) ?
                                            base_url('user/dist/img/'.\Classes\Config\Config::get('defaults/profile_pic')) :
                                            base_url('user/uploads/'.$member->photo_url);
                                        ?>" alt="" class="profile_img_icon">
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='profile_dropdown' class='dropdown-content'>
                                        <li><a href="<?php echo base_url('user/member/dashboard/profile/index.php') ?>">Dashboard</a></li>
                                        <li class="divider"></li>
                                        <li><a href="logout.php">Logout</a></li>
                                    </ul>
                                </li>
                        <?php else : ?>
                                <li><a href="register.php">Register</a></li>
                                <li><a href="login.php" class="btn btn-login">Login</a></li>
                        <?php endif; ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <!--  main menu area finish -->

    <div class="featured_area">
        <div class="container">
            <div class="row">
                <div class="col m8">
                    <div class="featured">
                        <div class="outer">
                            <div class="story">
                                <h4 class="title">Amazon Kindle aims to boost English writing</h4>
                                <p class="subtitle">When Amazon Kindle was launched in India in 2015, India was already the third largest country in the world in terms of English publishing. So the Kindle content was already relevant to Indian readers. They went on to add Indian English writers too. Today, they have thousands of Indian authors on board!</p>
                                <a href="#" class="waves-effect waves-light btn">READ FULL STORY</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- featured area finish -->
</div>
<!-- header wrapper finished -->
