<?php
/* @var $params */

$article = \classes\models\article\Article::getSpecified($params['id']);

if (!$article) {
    $not_found = "The article was not found!";
}

require_once('views/article/article.php');