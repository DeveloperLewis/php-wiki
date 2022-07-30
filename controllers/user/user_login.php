<?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        session_start();
        if (isset($_SESSION['uid'])) {
            header('Location: /');
            die();
        }
        
        require_once('views/user/login.php');
    }

    elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

        //Validation
        $empty_errors = [];

        if (!isset($_POST['email']) || empty($_POST['email'])){
            $empty_errors['email'] = "You must enter an email.";
        };

        if (!isset($_POST['password']) || empty($_POST['password'])){
            $empty_errors['password'] = "You must enter a password.";
        };

        if (!empty($empty_errors)) {
            session_start();
            $_SESSION['empty_errors'] = $empty_errors;

            if (isset($_POST['email'])) {
                $_SESSION['saved_values']['email'] = $_POST['email'];
            }

            header('Location: /user/login');
            die();
        }

        //Query the database for a user.
        $email = $_POST['email'];
        $password = $_POST['password'];

        $result = classes\models\user\User::authenticate($email, $password);

        if ($result == "execute failed") {
            session_start();
            $_SESSION['developer_errors'][] = "Something went wrong please try again or contact the site administrator. Error code: 7L9e3UwBC5";

            header('Location: /user/login');
            die();
        }

        if ($result == "fetch failed") {
            session_start();
            $_SESSION['login_error'] = "Email or password is incorrect, please try again.";

            header('Location: /user/login');
            die();
        }

        if ($result == "password failed") {
            session_start();
            $_SESSION['login_error'][] = "Email or password is incorrect, please try again.";

            header('Location: /user/login');
            die();
        }

        session_start();
        $_SESSION['uid'] = $result;

        header('Location: /');
        die();
    }

    else {
        return "Invalid request: " . $_SERVER['REQUEST_METHOD'];
    };