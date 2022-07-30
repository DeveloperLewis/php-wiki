<?php

namespace classes\models\article;

class Contributions
{
    public int $article_id;
    public int $uid;

    public function __construct($article_id, $uid) {
        $this->article_id = $article_id;
        $this->uid = $uid;
    }
}