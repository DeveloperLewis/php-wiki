<?php

namespace classes\models\user;

    class User {

        //Properties of the user
        public string $firstName;
        public string $email;
        public string $password;
        public bool $isAdmin;

        //Creating a new user
        public function __construct($firstName, $email, $password, $isAdmin) {
            $this->firstName = $firstName;
            $this->email = $email;
            $this->password = $password;
            $this->isAdmin = $isAdmin;
        }

        //Store the user in the database.
        public function store(): bool {
            $sql = "INSERT INTO users (first_name, email, password, is_admin) VALUES (?,?,?,?)";

            //Connect to database.
            $database = new \classes\Database();
            $pdo = $database->getPdo();

            //Prepared statements.
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $this->firstName, \PDO::PARAM_STR);
            $stmt->bindParam(2, $this->email, \PDO::PARAM_STR);
            $stmt->bindParam(3, $this->password, \PDO::PARAM_STR);
            $stmt->bindParam(4, $this->isAdmin, \PDO::PARAM_BOOL);

            //Return false if the statement failed.
            if (!$stmt->execute()) {
                return false;
            }

            return true;
        }

        //Check if the user exists and return their ID if the password matches the email.
        public static function authenticate($email, $password): string|int {
            //Connect to database.
            $database = new \classes\Database();
            $pdo = $database->getPdo();

            //Prepared Statements.
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bindParam(1, $email, \PDO::PARAM_STR);

            if (!$stmt->execute()) {
                return "execute failed";
            }

            if (!$user = $stmt->fetch()) {
                return "fetch failed";
            }

            //If given password does not match the one in the database, return string
            if(!password_verify($password, $user['password'])) {
                return "password failed";
            }

            return $user['uid'];
        }

        //Return a user object.
        public static function getName($uid): bool|array {
            //Database connection
            $database = new \classes\Database();
            $pdo = $database->getPdo();

            //Prepared statements
            $stmt = $pdo->prepare("SELECT first_name FROM users WHERE uid = ?");
            $stmt->bindParam(1, $uid, \PDO::PARAM_INT);

            if (!$stmt->execute()) {
                return false;
            }

            if (!$name = $stmt->fetch()) {
                return false;
            }

            return $name;
        }

        //Return the date of which the user was created at.
        public static function getCreatedAt($uid): bool|array {
            //Database connection
            $database = new \classes\Database();
            $pdo = $database->getPdo();


            //Prepared statements
            $stmt = $pdo->prepare("SELECT created_at FROM users WHERE uid = ?");
            $stmt->bindParam(1, $uid, \PDO::PARAM_INT);

            if (!$stmt->execute()) {
                return false;
            }

            if (!$createdAt = $stmt->fetch()) {
                return false;
            }
            return $createdAt;
        }

        //Return whether the email is unique within the database.
        public static function isEmailUnique($email): bool|int {
            //Database connection
            $database = new \classes\Database();
            $pdo = $database->getPdo();

            //Prepared statements
            $stmt = $pdo->prepare("SELECT email FROM users WHERE email = ?");
            $stmt->bindParam(1, $email, \PDO::PARAM_STR);

            if (!$stmt->execute()) {
                return 0;
            }

            if (empty($stmt->fetch())) {
                return true;
            }

            return false;
        }

        //Check whether the user is an admin or not.
        public static function isAdmin($uid): bool|string {
            //database connection
            $database = new \classes\Database();
            $pdo = $database->getPdo();

            //prepared statements
            $stmt = $pdo->prepare("SELECT is_admin FROM users WHERE uid = ?");
            $stmt->bindParam(1, $uid, \PDO::PARAM_INT);

            if (!$stmt->execute()) {
                return "execute failed";
            }

            if (!$result = $stmt->fetch()) {
                return "fetch failed";
            }

            //Check whether the user is an admin or not and return it
            if ($result['is_admin'] == 0) {
                return false;
            }
            else if ($result['is_admin'] == 1) {
                return true;
            }

            return "function failed";
        }

        //Get total count of users
        public static function getTotalUsers(): bool|int {
            $sql = "SELECT COUNT(uid) FROM users";

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
            return $result['COUNT(uid)'];
        }
    }