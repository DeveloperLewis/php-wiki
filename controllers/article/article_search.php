<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    session_start();
    if (isset($_GET['category'])) {
        if (!$articles = \classes\models\article\Article::getByCategory($_GET['category'])) {

        }
    }

    if (isset($_GET['search'])) {
        if (!$articles = \classes\models\article\Article::getByTitle($_GET['search'])) {
        }
    }

    require_once('views/article/search.php');
}

else {
    header('Location: /');
    die();
}
