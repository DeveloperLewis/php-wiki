<?php
/* @var $params */

//Get the article that the article_id matches
$article = \classes\models\article\Article::getSpecified($params['id']);

if (!$article) {
    $not_found = "The article was not found!";
}

session_start();

//If the user has not viewed the article recently/session not started, then count a new view to the article.
if (!isset($_SESSION['article_' . $params['id']])) {
    \classes\models\article\Article::updateViewCounter($params['id']);
    $_SESSION['article_' . $params['id']] = $params['id'];
}

require_once('views/article/article.php');