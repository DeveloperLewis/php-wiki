<?php

namespace classes;

class Functions
{
    //Takes an input of bytes and converts them to larger byte formats.
    public function convertBytes(float $bytes, string $type): float|string {
        if (strtolower($type) == "kb") {
            return $bytes / 1000;
        }

        else if (strtolower($type) == "mb") {
            return $bytes / pow(1000, 2);
        }

        else if (strtolower($type) == "gb") {
            return $bytes / pow(1000, 3);
        }

        else if (strtolower($type) == "tb") {
            return $bytes / pow(1000, 4);
        }

        else if (strtolower($type) == "pb") {
            return $bytes / pow(1000, 5);
        }

        else {
            return "Type is not defined.";
        }
    }

    //Return total storage usage of database and images in megabytes.
    public function totalStorageUsage(): bool|int {
        //Get total size in bytes of each table in the database.
        $sql = 'SELECT table_schema "name", ROUND(SUM(data_length + index_length) / 1024 / 1024, 1) "mb" FROM information_schema.tables GROUP BY table_schema';
        $database = new \classes\Database();
        $pdo = $database->getPdo();
        $stmt = $pdo->prepare($sql);

        if (!$stmt->execute()) {
            return false;
        }

        if (!$databases = $stmt->fetchAll()) {
            return false;
        }

        //Add all table sizes together
        $database_size = 0;
        foreach($databases as $database) {
            if ($database['name'] == "wiki") {
                $database_size = round($database['mb']);
            }
        }

        $sql = 'SELECT storage_size FROM images';
        $stmt = $pdo->prepare($sql);

        if (!$stmt->execute()) {
            return false;
        }

        if (!$image_storages = $stmt->fetchAll()) {
            return false;
        }

        //Add each image storage_size
        $image_storage_size_bytes = 0;
        foreach ($image_storages as $image_storage) {
            $image_storage_size_bytes += $image_storage['storage_size'];
        }

        //Convert bytes to megabytes and round it to the nearest integer
        $image_storage_size_mb = round($this->convertBytes($image_storage_size_bytes, "mb"));

        return $database_size + $image_storage_size_mb;
    }
}