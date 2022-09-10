<?php
session_start();
if(isset($_SESSION['uid'])) {
    //Check if the logged-in user is an admin to verify that only they can look at this page.
    if (\classes\models\user\User::isAdmin($_SESSION['uid'])) {
        $functions = new classes\Functions();
        require_once('views/admin/dashboard.php');
    }
}

else {
    header('Location: /');
    die();
}