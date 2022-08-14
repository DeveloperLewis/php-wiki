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

    public function store(): bool {
        $sql = "INSERT INTO articles (title, body, original_author, shared, creation_date, notes, category_ids) VALUES (?,?,?,?,?,?,?);";
        $nullvar = null;

        $database = new \classes\Database();
        $pdo = $database->getPdo();

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $this->title, \PDO::PARAM_STR);
        $stmt->bindParam(2, $this->body, \PDO::PARAM_STR);
        $stmt->bindParam(3, $this->original_author, \PDO::PARAM_INT);
        $stmt->bindParam(4, $this->shared, \PDO::PARAM_BOOL);
        $stmt->bindParam(5, $this->creation_date, \PDO::PARAM_STR);

        if (!empty($this->notes)) {
            $stmt->bindParam(6, $this->notes, \PDO::PARAM_STR);
        } else {
            $stmt->bindParam(6, $nullvar, \PDO::PARAM_NULL);
        }

        if (!empty($this->categories)) {
            $stmt->bindParam(7, $this->categories, \PDO::PARAM_STR);
        } else {
            $stmt->bindParam(7, $nullvar, \PDO::PARAM_NULL);
        }

        if (!$stmt->execute()) {
            return false;
        }

        return true;
    }

    public function setInitNotes($notes): bool {
        if ($this->notes = $notes) {
            return true;
        }
        return false;
    }

    public function setInitCategories($categories): bool {
        if ($this->categories = $categories) {
            return true;
        }
        return false;
    }

    public static function getAll($uid): bool|array {
        $sql = "SELECT * FROM articles WHERE original_author = ?";

        $database = new \classes\Database();
        $pdo = $database->getPdo();

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $uid, \PDO::PARAM_INT);

        if (!$stmt->execute()) {
            return false;
        }

        if (!$result = $stmt->fetchAll()) {
            return false;
        }

        return $result;

    }

}