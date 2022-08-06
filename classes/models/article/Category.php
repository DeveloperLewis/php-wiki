<?php

namespace classes\models\article;

class Category
{
    public string $category_name;


    public function __construct($category_name) {
        $this->category_name = $category_name;
    }

    public function store(): bool {
        $sql = "INSERT INTO categories (category_name) VALUES (?)";#

        $database = new \classes\Database();
        $pdo = $database->getPdo();

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $this->category_name, \PDO::PARAM_STR);

        if (!$stmt->execute()) {
            return false;
        }

        return true;
    }

    public static function getAll(): array|bool {
        $sql = "SELECT * FROM categories;";

        $database = new \classes\Database();
        $pdo = $database->getPdo();

        $stmt = $pdo->prepare($sql);

        if (!$stmt->execute()) {
            return false;
        }

        if (!$categories = $stmt->fetchAll()) {
            return false;
        }

        return $categories;
    }

}