<?php

namespace classes\models\article;

class Article
{
    public string $title; //required
    public string $body; //required
    public string $notes; //optional
    public int $original_author; //required
    public bool $shared; //required
    public string $creation_date; //required
    public string $last_edited_date; //optional
    public int $last_edited_by_author; //optional
    public string $template; //required

    public function __construct($title, $body, $original_author, $shared, $creation_date, $template) {
        $this->title = $title;
        $this->body = $body;
        $this->original_author = $original_author;
        $this->shared = $shared;
        $this->creation_date = $creation_date;
        $this->template = $template;
    }

}