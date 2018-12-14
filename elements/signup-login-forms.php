
<h1>Welcome to Project Share</h1>

<div class="card border-dark mt-3">

    <div class="card-body mx-3 my-1">

        <div class="row">


            <div class="col-sm-6">
                <h2>Sign In</h2>
                <?=!empty($_SESSION['login_attempt_msg']) ? $_SESSION['login_attempt_msg'] : '' ?>
                <form action="/users/login.php" method="post">

                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" type="text" name="username">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password">
                    </div>

                    <input type="submit" value="Submit">

                </form>

            </div><!-- .col-sm-6 -->

            <div class="col-sm-6">
                <h2>Create New Account</h2>

                <?= !empty($_SESSION['create_acc_msg']) ? $_SESSION['create_acc_msg'] : '' ?>

                <form action="/users/add.php" method="post">

                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" type="text" name="username" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password" required>
                    </div>

                    <div class="form-group">
                        <label>Your Timezone</label>

                        <select id="signup-timezone-select" class="form-control" name="timezone" required>
                            <option></option>
                            <?php
                            $timezone_identifiers = DateTimeZone::listIdentifiers();

                            foreach( $timezone_identifiers as $timezone ){
                                echo '<option value="'.$timezone.'">'.$timezone.'</option>';
                            }

                            ?>

                        </select>



                    </div>

                    <h4>Profile Info</h4>
                    <hr>

                    <div class="form-group">
                        <label>First Name</label>
                        <input class="form-control" type="text" name="firstname" required>
                    </div>

                    <div class="form-group">
                        <label>Last Name</label>
                        <input class="form-control" type="text" name="lastname" required>
                    </div>

                    <div class="form-group">
                        <label>Bio</label>
                        <textarea class="form-control" name="bio" required></textarea>
                    </div>

                    <input type="submit" value="Submit">

                </form>


            </div><!-- .col-sm-6 -->





        </div><!-- .row -->

    </div><!-- .card-body -->

</div><!-- .card -->
