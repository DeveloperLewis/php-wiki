<?php
function init() {

    //Database connection configuration and connection
    $host = "localhost";

    $username = "root";
    $password = "";

    try {
        $pdo = new PDO("mysql:host=$host", $username, $password);
    }
    catch (PDOException $e) {
        die("DB ERROR: " . $e->getMessage());
    }


    //Check if the database already exists, if so don't create anything new.
    $sql = "SHOW DATABASES LIKE 'wiki'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $database = $stmt->fetch();
    if (!empty($database)) {
        return false;
    }


    //Database schema creation
    $sql = "CREATE DATABASE IF NOT EXISTS wiki;";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "USE wiki";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL,
  `title` varchar(300) DEFAULT NULL,
  `body` mediumtext DEFAULT NULL,
  `notes` varchar(10000) DEFAULT NULL,
  `original_author` int(11) DEFAULT NULL,
  `shared` bit(1) DEFAULT NULL,
  `creation_date` tinytext NOT NULL,
  `last_edited_date` tinytext NOT NULL,
  `last_edited_by_author` int(11) NOT NULL,
  `category_ids` mediumtext DEFAULT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "CREATE TABLE `contributions` (
  `contribution_id` int(11) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `location` varchar(300) NOT NULL,
  `storage_size` int(11) NOT NULL,
  `uploader_id` int(11) NOT NULL,
  `upload_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `email` varchar(320) NOT NULL,
  `password` varchar(128) NOT NULL,
  `is_admin` bit(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "CREATE TABLE `visitors` (
  `visitor_id` int(11) NOT NULL,
  `visit_date` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `original_author` (`original_author`),
  ADD KEY `last_edited_by_author` (`last_edited_by_author`);";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "ALTER TABLE `contributions`
  ADD PRIMARY KEY (`contribution_id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `article_id` (`article_id`);";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "ALTER TABLE `visitors`
  ADD PRIMARY KEY (`visitor_id`);";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "ALTER TABLE `contributions`
  MODIFY `contribution_id` int(11) NOT NULL AUTO_INCREMENT;";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "ALTER TABLE `visitors`
  MODIFY `visitor_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "
ALTER TABLE `articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }
}

init();

//Self-destruct, never to be seen again.
unlink("init.php");