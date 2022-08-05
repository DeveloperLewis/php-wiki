<?php

session_start();
if (isset($_SESSION['uid'])) {
    if (\classes\models\user\User::isAdmin($_SESSION['uid'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //some code to delete the given category
        } else {
            header('Location: /');
            die();
        }
    }
} else {
    header('Location: /');
    die();
}