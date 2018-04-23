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
    $objValidation = new Validation();

if ($objMembershipService->isLoggedIn()) {
        Redirect::to('index.php');
    }

if (Input::exists()) {
        if (Token::check(Input::get('token'))) {
            $objValidation->validate($_POST,
                array(
                    'name' => array(
                        'required' => true,
                        'min' => 5
                    ),
                    'username' => array(
                        'required' => true,
                        'min' => 5,
                        'unique' => 'user'
                    ),
                    'email' => array(
                        'required' => true,
                        'unique' => 'user'
                    ),
                    'password' => array(
                        'required' => true,
                        'min' => 5
                    ),
                    'password_again' => array(
                        'required' => true,
                        'matches' => 'password'
                    ),
                    'dateOfBirth' => array(
                        'required' => true
                    )
                )
            );

            if ($objValidation->passed()) {
                $objMember = new Member();
                $objMember->name = Input::get('name');
                $objMember->setUsername(Input::get('username'));
                $objMember->setEmail(Input::get('email'));
                $objMember->setPassword(password_hash(Input::get('password'), PASSWORD_DEFAULT));
                $objMember->setDateOfBirth(Input::get('dateOfBirth'));
                $objMember->profession = Input::get('profession');
                $objMember->group_id = 1;


                $objMembershipService = new MembershipService();
                $inserted = $objMembershipService->register($objMember);

                if ($inserted) {
                    $loggedIn = $objMembershipService->login(Input::get('username'), password_hash(Input::get('password'), PASSWORD_DEFAULT), true);
                    Redirect::to('./');
                }

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
                            <?php
                                if ($objValidation->errors()) : ?>
                                    <div class="col s8 offset-s2 mb-30">
                                        <div class="card">
                                            <div class="card-content">
                                               <ul class="browser-default">
                                                   <?php foreach ($objValidation->errors() as $error) : ?>
                                                        <li class="red-text text-darken-1"><?php echo $error; ?></li>
                                                    <?php endforeach; ?>
                                               </ul>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                endif;
                            ?>
                            <form class="col s8 offset-s2" method="post" action="">

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="name" type="text" class="validate" name="name" value="<?php echo escape(Input::get('name')); ?>">
                                        <label for="name">Name</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="username" type="text" class="validate" name="username">
                                        <label for="username">Username</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="email" type="email" class="validate" name="email">
                                        <label for="email">Email</label>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="password" type="password" class="validate" name="password">
                                        <label for="password">Password</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="password_again" type="password" class="validate" name="password_again">
                                        <label for="password_again">Confirm_Password</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="dateOfBirth" type="text" class="datepicker" name="dateOfBirth">
                                        <label for="dateOfBirth">Date of Birth</label>
                                    </div>
                                </div>
                                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                <div class="right-align"><button class="waves-effect waves-light btn" type="submit">Register</button></div>
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