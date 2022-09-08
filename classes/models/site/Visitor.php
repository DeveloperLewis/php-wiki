<?php

namespace classes\models\site;

class Visitor
{
    public string $visit_date;

    public function __construct($visit_date) {
        $this->visit_date = $visit_date;
    }

    public function store(): bool {
        $sql = "INSERT INTO visitors (visit_date) VALUES (?);";

        //Database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        //Prepared statements
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $this->visit_date, \PDO::PARAM_STR);

        if (!$stmt->execute()) {
            return false;
        }

        return true;
    }
}