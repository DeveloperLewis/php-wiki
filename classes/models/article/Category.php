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

}