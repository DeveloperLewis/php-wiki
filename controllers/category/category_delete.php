<?php
session_start();
if(isset($_SESSION['uid'])) {
    if (\classes\models\user\User::isAdmin($_SESSION['uid'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];

                if (!\classes\models\article\Category::delete($id)) {
                    $_SESSION['delete_error'] = "There was an error trying to delete this article, please refresh the page and try again.";
                    header('Location: /admin/categories');
                    die();
                }
                header('Location: /admin/categories');
                die();
            }
        }
    }
}

else {
    header('Location: /');
    die();
}