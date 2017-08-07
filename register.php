<?php
    require_once "vendor/autoload.php";
    use \Classes\Validation\Input;
?>


<?php
    if (Input::exists()) {

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
                                        <input id="name" type="text" class="validate" name="name" >
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
                                        <input id="conpassword" type="password" class="validate" name="conpassword">
                                        <label for="conpassword">Confirm_Password</label>
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