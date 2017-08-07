<?php  require_once "views/includes/header.php" ?>

    <div class="content_area">
        <div class="container">
            <div class="row">
                <div class="col m9">
                    <div class="content">
                        <div class="register_block  clearfix">

                            <form class="col s8 offset-s2">

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


                                <div class="right-align"><a class="waves-effect waves-light btn" type="submit">Register</a></div>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="col m3">
                    <div class="sidebar_area">
                        <div class="sidebar_block categories">
                            <h5 class="title">categories</h5>
                            <ul>
                                <li><a href="#">Alvin</a></li>
                                <li><a href="#">Alvin</a></li>
                                <li><a href="#">Alvin</a></li>
                                <li><a href="#">Alvin</a></li>
                            </ul>
                        </div>

                        <div class="sidebar_block">
                            <h5 class="title">Tags</h5>
                            <div class="tags">
                                <a href="#">tech</a>
                                <a href="#">tech</a>
                                <a href="#">tech</a>
                                <a href="#">tecasdfsdfh</a>
                                <a href="#">tech</a>
                                <a href="#">tech</a>

                            </div>
                        </div>


                        <div class="sidebar_block most_rated">
                            <h5 class="title">Most Rated</h5>
                            <ul>
                                <li><a href="#">Lorem ipsum dolor sit amet, consectetur...</a></li>

                                <li><a href="#">Lorem ipsum dolor sit amet, consectetur...</a></li>

                                <li><a href="#">Lorem ipsum dolor sit amet, consectetur...</a></li>

                                <li><a href="#">Lorem ipsum dolor sit amet, consectetur...</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once "views/includes/footer.php" ?>