<?php
if (!$articles = classes\models\article\Article::getRecent(6)) {
    //TODO: Some code saying that no articles could be found, try creating some. Then show in index.php with a session

}
require_once('views/index.php');