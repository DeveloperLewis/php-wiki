<?php

namespace classes\models\article;

use classes\Database;

class Article
{
    public string $title; //required y
    public string $body; //required y
    public string $notes; //optional y
    public int $original_author; //required y
    public bool $shared; //required y
    public string $creation_date; //required y
    public int $last_edited_by_author; //optional
    public array $categories; //optional

    public function __construct($title, $body, $original_author, $shared, $creation_date) {
        $this->title = $title;
        $this->body = $body;
        $this->original_author = $original_author;
        $this->shared = $shared;
        $this->creation_date = $creation_date;
    }

    public function storeMinimum(): bool {
        $sql = "INSERT INTO articles (title, body, original_author, shared, creation_date) VALUES (?,?,?,?,?);";

        $database = new \classes\Database();
        $pdo = $database->getPdo();

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $this->title, \PDO::PARAM_STR);
        $stmt->bindParam(2, $this->body, \PDO::PARAM_STR);
        $stmt->bindParam(3, $this->original_author, \PDO::PARAM_INT);
        $stmt->bindParam(4, $this->shared, \PDO::PARAM_BOOL);
        $stmt->bindParam(5, $this->creation_date, \PDO::PARAM_STR);

        if (!$stmt->execute()) {
            return false;
        }

        return true;
    }

}