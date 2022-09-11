<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    session_start();
    if (isset($_GET['category'])) {
        if (!$articles = \classes\models\article\Article::getByCategory($_GET['category'])) {
            //TODO: Err message to display
        }
    }

    if (isset($_GET['search'])) {
        if (!$articles = \classes\models\article\Article::getByTitle($_GET['search'])) {
            //TODO: err message to display;
        }
    }

    require_once('views/article/search.php');
}

else {
    header('Location: /');
    die();
}
