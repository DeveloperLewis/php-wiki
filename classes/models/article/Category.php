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

    //Return all category objects as an array
    public static function getAll(): array|bool {
        $sql = "SELECT * FROM categories;";

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
}