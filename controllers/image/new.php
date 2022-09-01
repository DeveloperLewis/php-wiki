<?php
session_start();
if (isset($_SESSION['uid'])) {
    //Check if the logged-in user is an admin to verify that only they can look at this page.
    if (\classes\models\user\User::isAdmin($_SESSION['uid'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require_once('views/image/new.php');
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

        }
    }
} else {
    header('Location: /');
    die();
}