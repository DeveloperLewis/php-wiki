<?php
session_start();
if (isset($_SESSION['uid'])) {
    //Check if the logged-in user is an admin to verify that only they can look at this page.
    if (\classes\models\user\User::isAdmin($_SESSION['uid'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require_once('views/image/new.php');
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($_SERVER['CONTENT_LENGTH'] > 1000000) {
                    session_start();
                    $_SESSION['error'] = "The file must be less than 1mb.";
                    header('Location: /image/new');
                    die();
            }

            $functions = new classes\Functions();
            $size = $functions->convertBytes($_FILES['file']['size'], "kb");

            $target_dir = "public/imgs/";
            $target_file = $target_dir . basename($_FILES['file']['name']);
            $target_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $verify_img = getimagesize($_FILES["file"]["tmp_name"]);

            if (!$verify_img) {
                session_start();
                $_SESSION['error'] = "The file is not an image.";
                header('Location: /image/new');
                die();
            }

            if ($_FILES['file']['size'] > 1000000) {
                session_start();
                $_SESSION['error'] = "The file must be less than 1mb.";
                header('Location: /image/new');
                die();
            }

            if($target_file_type != "jpg" && $target_file_type != "png" && $target_file_type != "jpeg" && $target_file_type != "gif" ) {
                session_start();
                $_SESSION['error'] = "The file must only be either .jpg, .png, .jpeg or .gif";
                header('Location: /image/new');
                die();
            }

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                session_start();
                $_SESSION['success'] = "File was uploaded successfully!";
                header('Location: /admin/images');
                die();
            } else {
                session_start();
                $_SESSION['error'] = "The file failed to upload, please try again.";
                header('Location: /image/new');
                die();
            }


        }
    }
} else {
    header('Location: /');
    die();
}