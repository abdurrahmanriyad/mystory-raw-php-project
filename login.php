<?php
    session_start();
    require_once "vendor/autoload.php";
    use \Classes\Validation\Input;
    use \Classes\Member\Member;
    use \Classes\Member\MembershipService;
    use \Classes\Validation\Validation;
    use \Classes\Util\Token;
    use \Classes\Util\Session;
    use \Classes\Util\Redirect;
?>
<?php

    $objMembershipService = new MembershipService();

    if ($objMembershipService->isLoggedIn()) {
        Redirect::to('index.php');
    }

    $objMembershipService->checkIfRemembered();

    if (Input::exists()) {
        if (Token::check(Input::get('token'))) {

            $objValidation = new Validation();
            $objValidation->validate($_POST,
                array(
                    'username' => array(
                        'required' => true,
                        'min' => 5
                    ),
                    'password' => array(
                        'required' => true
                    )
                )
            );

            if ($objValidation->passed()) {
                $username = Input::get('username');
                $password = Input::get('password');

                $remember = (Input::get('remember') === 'on') ? true : false;
                $loggedIn = $objMembershipService->login($username, $password, $remember);

                if ($loggedIn) {
                    Redirect::to('index.php');
                }

            } else {
                print_r($objValidation->errors());
            }


        }
    }
?>

<?php  require_once "views/includes/header.php" ?>

    <div class="content_area">
        <div class="container">
            <div class="row">
                <div class="col m9">
                    <div class="content">
                        <div class="register_block  clearfix">

                            <form class="col s8 offset-s2" method="post" action="">

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="username" type="text" class="validate" name="username">
                                        <label for="username">Username</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="password" type="password" class="validate" name="password">
                                        <label for="password">Password</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s12">
                                        <input type="checkbox" class="filled-in" id="filled-in-box" checked="checked" name="remember"/>
                                        <label for="filled-in-box">Remember me</label>
                                    </div>
                                </div>

                                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                <div class="right-align"> <span class="reg-link"> Not a User? <a href="register.php">Register</a> </span> <button class="waves-effect waves-light btn" type="submit">Login</button></div>

                            </form>

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