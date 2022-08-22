<?php

session_start();
if (isset($_SESSION['uid'])) {
    if (\classes\models\user\User::isAdmin($_SESSION['uid'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require_once('views/category/new.php');
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
                header('Location: /category/new');
                die();
            }

            //Store the category
            $category = new \classes\models\article\Category($_POST['name']);
            $category->store();

            session_start();
            $_SESSION['success'] = "Successfully added a new category.";
            header('Location: /admin/categories');
            die();

        } else {
            header('Location: /');
            die();
        }
    }
} else {
    header('Location: /');
    die();
}