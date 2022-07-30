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

        //Return an array containing the user properties
        public function return(): array {
            return [$this->firstName, $this->email, $this->password];
        }

        //Store the user in the database.
        public function store(): bool {
            $sql = "INSERT INTO users (first_name, email, password, is_admin) VALUES (?,?,?,?)";

            $database = new \classes\Database();
            $pdo = $database->getPdo();

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $this->firstName, \PDO::PARAM_STR);
            $stmt->bindParam(2, $this->email, \PDO::PARAM_STR);
            $stmt->bindParam(3, $this->password, \PDO::PARAM_STR);
            $stmt->bindParam(4, $this->isAdmin, \PDO::PARAM_STR);
            
            if (!$stmt->execute()) {
                return false;
            }

            return true;
        }

        //Check if the user exists and return their ID if the password matches the email.
        public static function authenticate($email, $password): string|int {
            $database = new \classes\Database();
            $pdo = $database->getPdo();
            
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");

            $stmt->bindParam(1, $email, \PDO::PARAM_STR);

            if (!$stmt->execute()) {
                return "execute failed";
            }
            
            if (!$user = $stmt->fetch()) {
                return "fetch failed";
            }

            if(!password_verify($password, $user['password'])) {
                return "password failed";
            }

            return $user['uid'];
        }

        //Return a user object
        public static function getName($uid): bool|string {
            $database = new \classes\Database();
            $pdo = $database->getPdo();
            
            $stmt = $pdo->prepare("SELECT first_name FROM users WHERE uid = ?");
            $stmt->bindParam(1, $uid, \PDO::PARAM_STR);

            if (!$stmt->execute()) {
                return false;
            }

            if (!$name = $stmt->fetch()) {
                return false;
            }

            return $name;
        }

        //Return the date of which the user was created at.
        public static function getCreatedAt($uid): bool|string {
            $database = new \classes\Database();
            $pdo = $database->getPdo();
            
            $stmt = $pdo->prepare("SELECT created_at FROM users WHERE uid = ?");
            $stmt->bindParam(1, $uid, \PDO::PARAM_STR);

            if (!$stmt->execute()) {
                return false;
            }

            if (!$createdAt = $stmt->fetch()) {
                return false;
            }
            return $createdAt;
        }

        //Return whether or not the email is unique within the datbase.
        public static function isEmailUnique($email): bool|int {
            $database = new \classes\Database();
            $pdo = $database->getPdo();

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
    }