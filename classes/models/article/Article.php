<?php

namespace classes\models\article;

use classes\Database;

class Article
{
    public string $title;
    public string $body;
    public string $notes;
    public int $original_author;
    public bool $shared;
    public string $creation_date;
    public int $last_edited_by_author;
    public int $categories;

    public function __construct($title, $body, $original_author, $shared, $creation_date) {
        $this->title = $title;
        $this->body = $body;
        $this->original_author = $original_author;
        $this->shared = $shared;
        $this->creation_date = $creation_date;
    }

    //Store the article in the database
    public function store(): bool {
        $sql = "INSERT INTO articles (title, body, original_author, shared, creation_date, notes, category_ids) VALUES (?,?,?,?,?,?,?);";

        //null stored in a variable because bindParam uses variables only. For some reason.
        $null_var = null;

        //Database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        //Prepared statements
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $this->title, \PDO::PARAM_STR);
        $stmt->bindParam(2, $this->body, \PDO::PARAM_STR);
        $stmt->bindParam(3, $this->original_author, \PDO::PARAM_INT);
        $stmt->bindParam(4, $this->shared, \PDO::PARAM_BOOL);
        $stmt->bindParam(5, $this->creation_date, \PDO::PARAM_STR);

        //Check if object properties are empty or not and then bind accordingly.
        if (!empty($this->notes)) {
            $stmt->bindParam(6, $this->notes, \PDO::PARAM_STR);
        } else {
            $stmt->bindParam(6, $null_var, \PDO::PARAM_NULL);
        }

        if (!empty($this->categories)) {
            $stmt->bindParam(7, $this->categories, \PDO::PARAM_STR);
        } else {
            $stmt->bindParam(7, $null_var, \PDO::PARAM_NULL);
        }



        if (!$stmt->execute()) {
            return false;
        }

        return true;
    }

    //Set the notes property non-statically for first time the model is stored in the database
    public function setInitNotes($notes): bool {
        if ($this->notes = $notes) {
            return true;
        }
        return false;
    }

    //Set the categories property non-statically for first time the model is stored in the database
    public function setInitCategories($categories): bool {
        if ($this->categories = $categories) {
            return true;
        }
        return false;
    }

    //Return all articles
    public static function getAll($uid): bool|array {
        $sql = "SELECT * FROM articles WHERE original_author = ?";

        //Database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        //Prepared statements
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $uid, \PDO::PARAM_INT);

        if (!$stmt->execute()) {
            return false;
        }

        if (!$result = $stmt->fetchAll()) {
            return false;
        }

        //All articles
        return $result;

    }

    //Return the article based on the article_id provided
    public static function getSpecified($article_id): bool|array {
        $sql = "SELECT * FROM articles WHERE article_id = ?";

        //database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        //prepared statements
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $article_id, \PDO::PARAM_INT);

        if (!$stmt->execute()) {
            return false;
        }

        if (!$result = $stmt->fetch()) {
            return false;
        }

        //The specified article
        return $result;
    }

    public static function delete($article_id): bool {
        $sql = "DELETE FROM articles WHERE article_id = ?";

        //database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        //prepared statements
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $article_id, \PDO::PARAM_INT);

        if (!$stmt->execute()) {
            return false;
        }

        return true;
    }
}