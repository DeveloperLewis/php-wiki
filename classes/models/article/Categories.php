<?php

namespace classes\models\article;

class Categories
{
    public string $category_name;


    public function __construct($category_name) {
        $this->category_name = $category_name;
    }
}