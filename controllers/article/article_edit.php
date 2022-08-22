<?php
session_start();
if(isset($_SESSION['uid'])) {
    if (\classes\models\user\User::isAdmin($_SESSION['uid'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $article_id = $_GET['id'];

            //If the article could not be found via the ID
            if (!$article = \classes\models\article\Article::getSpecified($article_id)) {
                //some error to send through to articles panel via sessions

                header('Location: /admin/articles');
                die();
            }
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
