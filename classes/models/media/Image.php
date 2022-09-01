<?php

namespace classes\models\media;

class Image
{

    public string $location;
    public int $storage_size;
    public int $uploader_id;

    //Creating a new user
    public function __construct($location, $storage_size, $uploader_id) {
        $this->location = $location;
        $this->storage_size = $storage_size;
        $this->uploader_id = $uploader_id;
    }

    //Store the image location and size in the database.
    public function store(): bool {
        $sql = "INSERT INTO images (location, storage_size, uploader_id) VALUES (?,?,?)";

        //Database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        //Prepared statements
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $this->location, \PDO::PARAM_STR);
        $stmt->bindParam(2, $this->storage_size, \PDO::PARAM_INT);
        $stmt->bindParam(3, $this->uploader_id, \PDO::PARAM_INT);

        if (!$stmt->execute()) {
            return false;
        }

        return true;
    }

    //Get all image locations from database
    public static function getAll(): bool|array {
        $sql = "SELECT * FROM images";

        //Database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        //Prepared statements
        $stmt = $pdo->prepare($sql);

        if (!$stmt->execute()) {
            return false;
        }

        if (!$images = $stmt->fetchAll()) {
            return false;
        }

        //All articles
        return $images;
    }
}