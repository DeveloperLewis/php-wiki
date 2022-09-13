<?php
session_start();
if (isset($_SESSION['uid'])) {
    //Check if the logged-in user is an admin to verify that only they can look at this page.
    if (\classes\models\user\User::isAdmin($_SESSION['uid'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require_once('views/image/new.php');

        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Image upload validation
            if ($_SERVER['CONTENT_LENGTH'] > 1000000) {
                    session_start();
                    $_SESSION['error'] = "The file must be less than 1mb.";
                    header('Location: /image/new');
                    die();
            }

            if (empty($_FILES['file']["tmp_name"])) {
                session_start();
                $_SESSION['error'] = "The file upload is empty.";
                header('Location: /image/new');
                die();
            }

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

            if (file_exists($target_file)) {
                session_start();
                $_SESSION['error'] = "Image already exists!";
                header('Location: /image/new');
                die();
            }

            if ($_FILES['file']['size'] > 1000000) {
                session_start();
                $_SESSION['error'] = "The file must be less than 1mb.";
                header('Location: /image/new');
                die();
            }

            if (strlen($target_file) > 250) {
                session_start();
                $_SESSION['error'] = "The file name must be less than 250 characters.";
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
                $timezone = 'Europe/London';
                $timestamp = time();
                $dt = new DateTime("now", new DateTimeZone($timezone));
                $dt->setTimestamp($timestamp);
                $upload_date = $dt->format('d/m/Y');

                //Store image data in the database
                $image = new \classes\models\media\Image($target_file, $_FILES['file']['size'], $_SESSION['uid'], $upload_date);
                if (!$image->store()) {
                    session_start();
                    $_SESSION['error'] = "The file data failed to store in the database, but still saved on the server. Contact Administrator.";
                    header('Location: /image/new');
                    die();
                }

                session_start();
                $_SESSION['success'] = "File was uploaded successfully!";
                header('Location: /admin/images?amount=0');
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