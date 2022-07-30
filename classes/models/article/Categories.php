<?php

namespace classes\models\article;

class Categories
{
    public string $category_name;
    public int $article_id;


    public function __construct($category_name, $article_id) {
        $this->category_name = $category_name;
        $this->article_id = $article_id;
    }
}