<?php
    require_once "vendor/autoload.php";
    use \Classes\Validation\Input;
    use \Classes\Validation\Validation;
    use \Classes\Util\Token;
    use \Classes\Util\Session;

?>


<?php
    if (Input::exists()) {
        if (Token::check(Input::get('token'))) {

            $objValidation = new Validation();
            $objValidation->validate($_POST,
                array(
                    'name' => array(
                        'required' => true,
                        'min' => 5,
                        'max' => 20,
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
                    'email' => array(
                        'required' => true
                    )
                )
            );

            if ($objValidation->passed()) {
                Session::flash("success", "User created successfully!");
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
                                        <input id="name" type="text" class="validate" name="name" value="<?php echo escape(Input::get('name')); ?>">
                                        <label for="name">Name</label>
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
                                        <select class="select">
                                          <option value="" disabled selected>Choose your option</option>
                                          <option value="1">Option 1</option>
                                          <option value="2">Option 2</option>
                                          <option value="3">Option 3</option>
                                        </select>
                                        <label>Profession</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="text" class="datepicker">
                                        <label for="dateofbirth">Date of Birth</label>
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