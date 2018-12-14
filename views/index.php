<?php  require_once("../core/includes.php");
    // unique html head vars
    $title = 'Home Page';
    require_once("../elements/html_head.php");
    require_once("../elements/nav.php");

?>

    <div class="container">


        <?php

        if( empty($_SESSION['user_logged_in']) ){ // user not logged in
            // Show login/signup forms
            require_once '../elements/signup-login-forms.php';
        }else{ // user is logged in ?>

            <div class="row">

                <div class="col-md-8">

                    <div class="card border-success mt-3">

                        <div class="card-header">
                            <h4>Share New Project:</h4>
                        </div><!-- .card-header -->

                        <div class="card-body">

                            <form action="/projects/add.php" method="post" enctype="multipart/form-data">
                                <img id="img-preview">
                                <div class="form-group">
                                    <input id="file-with-preview" type="file" name="fileToUpload" onchange="previewFile()" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="title" placeholder="Project Title:" required>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="description" placeholder="Project Description:" required></textarea>
                                </div>

                                <input class="btn btn-primary" type="submit" value="Submit">

                            </form>

                        </div><!-- .card-body -->

                    </div><!-- .card -->

                    <?php
                    $p = new Project;
                    $projects = $p->get_all();
                    

                    foreach($projects as $project){
                    ?>

                    <div class="card mt-3">


                        <div class="card-header">
                            <h4><?=$project['firstname'] . ' ' . $project['lastname']?>
                                <?php
                                if( $project['user_id'] == $_SESSION['user_logged_in'] ){ ?>
                                    <span class="float-right">
                                        <a href="/projects/edit.php?id=<?=$project['id']?>">
                                            <i class="far fa-edit" aria-hidden="true"></i>
                                        </a>
                                        <a class="delete-btn text-danger" href="/projects/delete.php?id=<?=$project['id']?>">
                                            <i class="far fa-trash-alt" aria-hidden="true"></i>
                                        </a>
                                    </span>

                                <?php
                                }
                                 ?>

                            </h4>
                        </div><!-- .card-header -->


                        <div class="card-body">
                            <img class="img-fluid" src="/assets/files/<?=$project['filename']?>">
                            <br><br>
                            <h5><?=$project['title']?></h5>
                            <p><?=$project['description']?></p>

                            <p>Posted on: <?=date('M. d, Y h:i a', $project['posted_time'])?></p>
                        </div><!-- .card-body -->
                    </div><!-- .card -->

                <?php } // end foreach ?>


                </div><!-- .col-md-8 -->

                <div class="col-md-4">
                    <?php // Search Bar ?>

                    <div class="mt-3 mb-3">
                        <h4>Search Projects</h4>

                        <div class="list-group">
                            <div class="list-group-item">

                                <form action="/" method="get">
                                    <div class="form-group">
                                        <label>Search</label>
                                        <input type="text" name="search">
                                    </div>
                                    <input type="submit" value="Submit">
                                </form>



                            </div>
                        </div>

                    </div>


                </div><!-- .col-md-4 -->


            </div><!-- .row -->

        <?php
        }


        ?>


    </div><!-- .container -->

<?php require_once("../elements/footer.php");
