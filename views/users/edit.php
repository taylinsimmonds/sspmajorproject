<?php
require_once '../../core/includes.php';

$u = new User;

if( !empty($_POST) ){ // Form was submitted
    $u->edit();
    header('Location: /users/');
    exit();
}

$user = $u->get_by_id($_SESSION['user_logged_in']);


$title = 'Edit Profile';
require_once '../../elements/html_head.php';
require_once '../../elements/nav.php';


?>

<div class="container">


    <div class="row">

        <div class="col-sm-6">
            <h2>Edit Profile</h2>


            <form method="post">

                <div class="form-group">
                    <label>Username</label>
                    <input class="form-control" type="text" name="username" value="<?=$user['username']?>" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" type="password" name="password" value="" placeholder="Leave empty to keep same password">
                </div>

                <div class="form-group">
                    <label>Your Timezone</label>

                    <select class="form-control chosen-select" name="timezone" required>
                        <option></option>
                        <?php
                        $timezone_identifiers = DateTimeZone::listIdentifiers();

                        foreach( $timezone_identifiers as $timezone ){

                            $selected = $timezone == $user['timezone'] ? 'selected' : '';

                            echo '<option value="'.$timezone.'" '.$selected.'>'.$timezone.'</option>';
                        }

                        ?>

                    </select>



                </div>

                <h4>Profile Info</h4>
                <hr>

                <div class="form-group">
                    <label>First Name</label>
                    <input class="form-control" type="text" name="firstname" value="<?=$user['firstname']?>" required>
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input class="form-control" type="text" name="lastname" value="<?=$user['lastname']?>" required>
                </div>

                <div class="form-group">
                    <label>Bio</label>
                    <textarea class="form-control" name="bio" required><?=$user['bio']?></textarea>
                </div>

                <input type="submit" value="Submit">

            </form>


        </div><!-- .col-sm-6 -->


    </div><!-- .row -->




</div><!-- .container -->




<?php require_once '../../elements/footer.php';
