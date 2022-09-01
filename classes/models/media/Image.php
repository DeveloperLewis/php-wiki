<?php

namespace classes\models\media;

class Image
{

    public string $location;
    public int $storage_size;
    public int $uploader_id;
    public string $upload_date;

    //Creating a new user
    public function __construct($location, $storage_size, $uploader_id, $upload_date) {
        $this->location = $location;
        $this->storage_size = $storage_size;
        $this->uploader_id = $uploader_id;
        $this->upload_date = $upload_date;
    }

    //Store the image location and size in the database.
    public function store(): bool {
        $sql = "INSERT INTO images (location, storage_size, uploader_id, upload_date) VALUES (?,?,?,?)";

        //Database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        //Prepared statements
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $this->location, \PDO::PARAM_STR);
        $stmt->bindParam(2, $this->storage_size, \PDO::PARAM_INT);
        $stmt->bindParam(3, $this->uploader_id, \PDO::PARAM_INT);
        $stmt->bindParam(4, $this->upload_date, \PDO::PARAM_STR);

        if (!$stmt->execute()) {
            return false;
        }

        return true;
    }

    //Get all images locations from database
    public static function getAll(): bool|array {
        $sql = "SELECT * FROM images ORDER BY image_id DESC";

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

    public static function deleteById($id): bool {
        $sql = "DELETE FROM images WHERE image_id = ?";

        //Database connection
        $database = new \classes\Database();
        $pdo = $database->getPdo();

        //Prepared statements
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $id, \PDO::PARAM_INT);

        if (!$stmt->execute()) {
            return false;
        }

        return true;
    }

    public static function getTotalCount(): bool|int {
        $sql = "SELECT COUNT(image_id) FROM images";

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
        //The total amount of articles based on the user
        return $result['COUNT(image_id)'];

    }
}