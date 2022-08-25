<?php
session_start();
if (isset($_SESSION['uid'])) {
    if (\classes\models\user\User::isAdmin($_SESSION['uid'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $category_id = $_GET['id'];

            //If the article could not be found via the ID
            if (!$category = \classes\models\article\Category::getById($category_id)) {
                //some error to send through to articles panel via sessions

                header('Location: /admin/categories');
                die();
            }

            require_once('views/category/edit.php');
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Check if the category name meets the validation requirements, if not
            //then get the returned array and send it through for errors.
            $validation = new \classes\Validation();
            $validation_result = $validation->category($_POST['name']);

            //Check if the variable is an array (Which means it has an array of errors)
            if (is_array($validation_result)) {
                session_start();
                $_SESSION['errors'] = $validation_result;
                $_SESSION['previous'] = $_POST['name'];
                header('Location: /category/edit?id=' . $_POST['id']);
                die();
            }

            //Update the category
            if (!\classes\models\article\Category::update($_POST['name'], $_POST['id'])) {
                session_start();
                $_SESSION['error'] = "Failed to update category, id: " . $_POST['id'];
                $_SESSION['previous'] = $_POST['name'];
                header('Location: /category/edit');
                die();
            };

            session_start();
            $_SESSION['success'] = "Successfully edited the category from " .  $_POST['previous'] . " to " . $_POST['name'] ;
            header('Location: /admin/categories');
            die();
        }
    }
}

else {
    header('Location: /');
    die();
}
