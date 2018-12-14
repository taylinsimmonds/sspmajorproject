<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">Project Share</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">

    <?php
    // Check if user is logged in. Show welcome links
    if( $_SESSION['user_logged_in'] ){

        $u = new User;
        $user = $u->get_by_id($_SESSION['user_logged_in']);

        ?>

          <li class="nav-item dropdown mr-5">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Welcome <?=$user['firstname']?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

              <a class="dropdown-item" href="/users/">My Profile</a>

              <a class="dropdown-item" href="/users/logout.php">Logout</a>

            </div>
          </li>
  <?php }else{ // user not logged in. ?>




    <?php } ?>


    </ul>

  </div>
</nav>
