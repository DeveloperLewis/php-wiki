<?php
session_start();
if(isset($_SESSION['uid'])) {
    //Check if the logged-in user is an admin to verify that only they can look at this page.
    if (\classes\models\user\User::isAdmin($_SESSION['uid'])) {
        if (!$articles = classes\models\article\Article::getRecent(1)) {
            //TODO: Some code saying that no articles could be found, try creating some. Then show in index.php with a session
        }
            require_once('views/admin/dashboard.php');
    }
}

else {
    header('Location: /');
    die();
}