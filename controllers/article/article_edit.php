<?php
session_start();
if(isset($_SESSION['uid'])) {
    if (\classes\models\user\User::isAdmin($_SESSION['uid'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require_once('views/article/edit.php');
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "hi";
        }
    }
}

else {
    header('Location: /');
    die();
}
