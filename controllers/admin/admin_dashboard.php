<?php
session_start();
if(isset($_SESSION['uid'])) {
    if (\classes\models\user\User::isAdmin($_SESSION['uid'])) {
        require_once('views/admin/dashboard.php');
    }
}

else {
    header('Location: /');
    die();
}