<?php

class Project extends Db {

    function get_all(){

        if( !empty($_GET['search']) ){ // They're searching something

            $search = $this->params['search'];

            $sql = "SELECT projects.*, users.username, users.firstname, users.lastname FROM projects LEFT JOIN users ON projects.user_id = users.id WHERE projects.title LIKE '%$search%' OR projects.description OR CONCAT(users.firstname, ' ', users.lastname) LIKE '%$search%' ORDER BY projects.posted_time DESC";

        }else{ // They're not searching
            $sql = "SELECT projects.*, users.username, users.firstname, users.lastname FROM projects LEFT JOIN users ON projects.user_id = users.id ORDER BY projects.posted_time DESC";
        }



        $projects = $this->select($sql);

        return $projects;

    }

    function get_by_id($id){

        $id = (int)$id;

        $sql = "SELECT * FROM projects WHERE id = '$id'";

        $project = $this->select($sql)[0];

        return $project;

    }

    function add(){

        $title = $this->data['title'];
        $description = $this->data['description'];
        $user_id = (int)$_SESSION['user_logged_in'];
        $util = new Util;
        $filename = $util->file_upload();
        $current_time = time();

        $sql = "INSERT INTO projects (title, description, filename, posted_time, user_id) VALUES ('$title', '$description', '$filename', '$current_time', '$user_id')";

        $this->execute($sql);

    }

    function edit($id){

        $id = (int)$id;
        $this->check_ownership($id); // Make sure user owns post that's being editted

        $title = $this->data['title'];
        $description = $this->data['description'];
        $current_user_id = (int)$_SESSION['user_logged_in'];

        if( !empty($_FILES['fileToUpload']['name']) ) { // Check if new file submitted

            // Delete the old project image file
            $old_project_image = trim($this->get_by_id($id)['filename']);
            if( !empty($old_project_image) ){
                if( file_exists(APP_ROOT.'/views/assets/files/'.$old_project_image )){
                    unlink( APP_ROOT.'/views/assets/files/'.$old_project_image );
                }
            }

            $util = new Util;
            $filename = $util->file_upload();

            $sql = "UPDATE projects SET title='$title', description='$description', filename='$filename' WHERE id='$id' AND user_id='$current_user_id'";

            $this->execute($sql);



        }else{ // if no new file was submitted

            $sql = "UPDATE projects SET title='$title', description='$description' WHERE id='$id' AND user_id='$current_user_id'";

            $this->execute($sql);

        }

    }

    function delete(){

        $current_user_id = (int)$_SESSION['user_logged_in'];
        $id = (int)$_GET['id'];
        $this->check_ownership($id);

        // Delete the old project image file
        $project_image = trim($this->get_by_id($id)['filename']);
        if( !empty($project_image) ){
            if( file_exists(APP_ROOT.'/views/assets/files/'.$project_image )){
                unlink( APP_ROOT.'/views/assets/files/'.$project_image );
            }
        }

        $sql = "DELETE FROM projects WHERE id='$id' AND user_id='$current_user_id'";
        $this->execute($sql);

    }

    function check_ownership($id){

        $id = (int)$id;

        $sql = "SELECT * FROM projects WHERE id = '$id'";

        $project = $this->select($sql)[0];

        if( $project['user_id'] == $_SESSION['user_logged_in'] ){
            return true;
        }else{
            header("Location: /");
            exit();
        }

    }

}
