<?php

namespace classes\models\article;

class Category
{
    public string $category_name;


    public function __construct($category_name) {
        $this->category_name = $category_name;
    }
    //Store the given category object
    public function store(): bool {
        $sql = "INSERT INTO categories (category_name) VALUES (?)";#

        //Database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        //Prepared statements
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $this->category_name, \PDO::PARAM_STR);

        if (!$stmt->execute()) {
            return false;
        }

        return true;
    }

    public static function update($category_name, $category_id): bool {
        $sql = "UPDATE categories SET category_name = ? WHERE category_id = ?";

        //Database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $category_name, \PDO::PARAM_STR);
        $stmt->bindParam(2, $category_id, \PDO::PARAM_INT);

        if (!$stmt->execute()) {
            return false;
        }

        return true;
    }

    //Return all category objects as an array
    public static function getAll(): array|bool {
        $sql = "SELECT * FROM categories ORDER BY category_id DESC";

        //Database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        //Prepared statement
        $stmt = $pdo->prepare($sql);

        if (!$stmt->execute()) {
            return false;
        }

        if (!$categories = $stmt->fetchAll()) {
            return false;
        }

        //Return all categories as an array
        return $categories;
    }

    //Get the name of a specified category
    public static function getName($category_id): array|bool {
        $sql = "SELECT category_name FROM categories WHERE category_id = ?";

        //Database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        //prepared statement
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $category_id, \PDO::PARAM_INT);

        if (!$stmt->execute()) {
            return false;
        }

        if (!$name = $stmt->fetch()) {
            return false;
        }

        //Return name
        return $name;
    }

    //Delete a specified category
    public static function delete($category_id): bool {
        $sql = "DELETE FROM categories WHERE category_id = ?";

        //database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        //prepared statements
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $category_id, \PDO::PARAM_INT);

        if (!$stmt->execute()) {
            return false;
        }

        return true;
    }

    //Get the total amount of categories in the database
    public static function getTotalCount(): bool|array {
        $sql = "SELECT COUNT(category_id) FROM categories";

        //database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        $stmt = $pdo->prepare($sql);

        if (!$stmt->execute()) {
            return false;
        }

        if (!$result = $stmt->fetch()) {
            return false;
        }

        //The total amount of categories
        return $result;

    }

    //Get a category by a specified id
    public static function getById($category_id): bool|array {
        $sql = "SELECT * FROM categories WHERE category_id = ?";

        //database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        //prepared statements
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $category_id, \PDO::PARAM_INT);

        if (!$stmt->execute()) {
            return false;
        }

        if (!$result = $stmt->fetch()) {
            return false;
        }

        //The specified category
        return $result;
    }

    //Check if the category name is unique
    public static function isCategoryUnique($category_name): bool|int {
        $sql = "SELECT category_name FROM categories WHERE category_name = ?";
        //Database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        //Prepared statements
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $category_name, \PDO::PARAM_STR);

        if (!$stmt->execute()) {
            return 0;
        }

        if (empty($stmt->fetch())) {
            return true;
        }

        return false;
    }

    //Check if the category is in use by an article
    public static function isCategoryInUse($category_id): bool|array {
        $sql = "SELECT COUNT(category_ids) FROM articles where category_ids = ?";

        //database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $category_id, \PDO::PARAM_STR);

        if (!$stmt->execute()) {
            return false;
        }

        if (!$result = $stmt->fetch()) {
            return false;
        }

        if ($result['COUNT(category_ids)'] > 0) {
            return true;
        }

        return false;
    }

    //Limit and offset the amount of categories returned for pagination usage.
    public static function pagination($amount, $offset): bool|array {
        $sql = "SELECT * FROM categories ORDER BY category_id DESC LIMIT " . $amount . " OFFSET " . $offset;

        //Database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        //Prepared statements
        $stmt = $pdo->prepare($sql);

        if (!$stmt->execute()) {
            return false;
        }

        if (!$categories = $stmt->fetchAll()) {
            return false;
        }

        //categories for pagination
        return $categories;
    }
}