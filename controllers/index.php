<?php
if (!$articles = classes\models\article\Article::getRecent(6)) {
}

if (!isset($_SESSION['new_visitor'])) {
    $timezone = 'Europe/London';
    $timestamp = time();
    $dt = new DateTime("now", new DateTimeZone($timezone));
    $dt->setTimestamp($timestamp);
    $date = $dt->format('d.m.Y H:i:s');

    $visitor = new \classes\models\site\Visitor($date);

    if ($visitor->store()) {
        $_SESSION['new_visitor'] = true;
    }
}

require_once('views/index.php');