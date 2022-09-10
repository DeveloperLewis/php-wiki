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
    public string $last_edited_date;
    public int $last_edited_by_author;
    public int $categories;

    public function __construct($title, $body, $original_author, $shared, $creation_date, $last_edited_date) {
        $this->title = $title;
        $this->body = $body;
        $this->original_author = $original_author;
        $this->shared = $shared;
        $this->creation_date = $creation_date;
        $this->last_edited_date = $last_edited_date;
    }

    //Store the article in the database
    public function store(): bool {
        $sql = "INSERT INTO articles (title, body, original_author, shared, creation_date, notes, category_ids, last_edited_date) VALUES (?,?,?,?,?,?,?,?);";

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

        $stmt->bindParam(8, $this->last_edited_date, \PDO::PARAM_STR);

        if (!$stmt->execute()) {
            return false;
        }

        return true;
    }

    public static function update($title, $body, $original_author, $shared, $notes, $categories, $article_id, $last_edited_date): bool {
        $sql = "UPDATE articles SET title = ?, body = ?, original_author = ?, shared = ?, last_edited_date = ?, notes = ?, category_ids = ? WHERE article_id = ?";

        //null stored in a variable because bindParam uses variables only. For some reason.
        $null_var = null;

        //Database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        //Prepared statements
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $title, \PDO::PARAM_STR);
        $stmt->bindParam(2, $body, \PDO::PARAM_STR);
        $stmt->bindParam(3, $original_author, \PDO::PARAM_INT);
        $stmt->bindParam(4, $shared, \PDO::PARAM_BOOL);
        $stmt->bindParam(5, $last_edited_date, \PDO::PARAM_STR);

        //Check if object properties are empty or not and then bind accordingly.
        if (!empty($notes)) {
            $stmt->bindParam(6, $notes, \PDO::PARAM_STR);
        } else {
            $stmt->bindParam(6, $null_var, \PDO::PARAM_NULL);
        }

        if (!empty($categories)) {
            $stmt->bindParam(7, $categories, \PDO::PARAM_STR);
        } else {
            $stmt->bindParam(7, $null_var, \PDO::PARAM_NULL);
        }

        $stmt->bindParam(8, $article_id, \PDO::PARAM_INT);

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
        $sql = "SELECT * FROM articles WHERE original_author = ? ORDER BY article_id DESC ";

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

    public static function pagination($uid, $amount, $offset): bool|array {
        $sql = "SELECT * FROM articles WHERE original_author = ? ORDER BY article_id DESC LIMIT " . $amount . " OFFSET " . $offset;

        //Database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        //Prepared statements
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $uid, \PDO::PARAM_INT);

        if (!$stmt->execute()) {
            return false;
        }

        if (!$articles = $stmt->fetchAll()) {
            return false;
        }

        //articles for pagination
        return $articles;
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

    public static function getTotalCount($uid): bool|array {
        $sql = "SELECT COUNT(original_author) FROM articles WHERE original_author = ?";

        //database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $uid, \PDO::PARAM_INT);

        if (!$stmt->execute()) {
            return false;
        }

        if (!$result = $stmt->fetch()) {
            return false;
        }

        //The total amount of articles based on the user
        return $result;

    }

    public static function getRecent(int $amount): bool|array {
        $sql = "SELECT * FROM articles ORDER BY article_id DESC LIMIT " . $amount;

        //Database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        //Prepared statements
        $stmt = $pdo->prepare($sql);

        if (!$stmt->execute()) {
            return false;
        }

        if (!$result = $stmt->fetchAll()) {
            return false;
        }

        //the most recent articles
        return $result;
    }

    public static function getArticleViews(int $article_id): bool|int {
        $sql = "SELECT views FROM articles WHERE article_id = ?";

        //Database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        //Prepared statements
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $article_id, \PDO::PARAM_INT);

        if (!$stmt->execute()) {
            return false;
        }

        if (!$result = $stmt->fetchAll()) {
            return false;
        }

        //returns views for specified article
        return $result[0]['views'];
    }

    public static function updateViewCounter(int $article_id): bool {
        //Get current views of article
        $views = self::getArticleViews($article_id);

        //Add 1 more view to article views.
        $views += 1;

        //Update this in the database for the next time.
        $sql = "UPDATE articles SET views = ? WHERE article_id = ?";

        //Database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        //Prepared statements
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $views, \PDO::PARAM_INT);
        $stmt->bindParam(2, $article_id, \PDO::PARAM_INT);

        if (!$stmt->execute()) {
            return false;
        }

        return true;
    }

    public static function totalArticleViewsForAll(): bool|int {
        $sql = "SELECT views FROM articles";

        //Database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        //Prepared statements
        $stmt = $pdo->prepare($sql);

        if (!$stmt->execute()) {
            return false;
        }

        if (!$article_views_arrays = $stmt->fetchAll()) {
            return false;
        }

        $total_views = 0;
        foreach ($article_views_arrays as $article_views_array) {
            $total_views += $article_views_array['views'];
        }

        return $total_views;
    }

    public static function getByCategory($category_id): bool|array {
        $sql = "SELECT * FROM articles WHERE category_ids = ?";

        //database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        //prepared statements
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $category_id, \PDO::PARAM_INT);

        if (!$stmt->execute()) {
            return false;
        }

        if (!$result = $stmt->fetchAll()) {
            return false;
        }

        //return articles queried by category id
        return $result;
    }
}