<?php
session_start();
if(isset($_SESSION['uid'])) {
    if (\classes\models\user\User::isAdmin($_SESSION['uid'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require_once('views/admin/dashboard.php');
        }

        elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validation = new \classes\Validation();
            $validation_result_for_title = $validation->title($_POST['title']);
            $validation_result_for_body = $validation->body(($_POST['body']));
            $validation_result_for_notes = $validation->notes($_POST['notes']);

            if (is_array($validation_result_for_body)) {
                session_start();
                $_SESSION['title_errors'] = $validation_result_for_title;
                $_SESSION['title_previous'] = $_POST['title'];
            }

            if (is_array($validation_result_for_body)) {
                session_start();
                $_SESSION['body_errors'] = $validation_result_for_body;
                $_SESSION['body_previous'] = $_POST['body'];
            }

            if (is_array($validation_result_for_body)) {
                session_start();
                $_SESSION['notes_errors'] = $validation_result_for_notes;
                $_SESSION['notes_previous'] = $_POST['notes'];
            }

            //TODO: Process the errors on the article_new.panel. So they are visible and show what the user entering incorrectly.
            if (isset($_SESSION['notes_errors']) || isset($_SESSION['title_errors']) || isset($_SESSION['body_errors'])) {
                header('Location: /article/new');
                die();
            }

            //TODO: Create the class handlers to be able to store the data into the database next!

        }
        else {
            header('Location: /');
            die();
        }
    }
}

else {
    header('Location: /');
    die();
}