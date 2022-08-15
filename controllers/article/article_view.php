<?php
/* @var $params */

//Get the article that the article_id matches
$article = \classes\models\article\Article::getSpecified($params['id']);

if (!$article) {
    $not_found = "The article was not found!";
}

session_start();
require_once('views/article/article.php');