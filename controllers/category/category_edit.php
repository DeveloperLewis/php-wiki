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
            echo "hi";
        }
    }
}

else {
    header('Location: /');
    die();
}
