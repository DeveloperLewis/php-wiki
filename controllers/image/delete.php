<?php
session_start();
if (isset($_SESSION['uid'])) {
    //Check if the logged-in user is an admin to verify that only they can look at this page.
    if (\classes\models\user\User::isAdmin($_SESSION['uid'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $img_location = $_POST['location'];
            $img_id = $_POST['id'];

            //Delete the image on the server or return error
            if (!unlink($img_location)) {
                session_start();
                $_SESSION['error'] = "Failed to delete the image.";
                header('Location: /admin/images?amount=0');
                die();
            }

            //Delete the image data stored in the database or return error
            if (!\classes\models\media\Image::deleteById($img_id)) {
                session_start();
                $_SESSION['error'] = "Failed to delete the image data.";
                header('Location: /admin/images?amount=0');
                die();
            }

            //Return success message if image was properly deleted
            session_start();
            $_SESSION['success'] = "The file was successfully deleted.";
            header('Location: /admin/images?amount=0');
            die();
        }
    }
}