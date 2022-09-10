<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['category'])) {
        if (!$articles = \classes\models\article\Article::getByCategory($_GET['category'])) {
            //TODO: Err message to display
        }
    }

    require_once('views/article/search.php');
}

else {
    header('Location: /');
    die();
}
