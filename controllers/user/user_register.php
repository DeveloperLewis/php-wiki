<?php
    //Check if the route was a GET method and do the following:
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        session_start();
        //If user is logged in
        if (isset($_SESSION['uid'])) {
            header('Location: /');
            die();
        }

        require_once('views/user/register.php');
    }

    //Check if the route was a POST method and do the following:
    elseif($_SERVER['REQUEST_METHOD'] == 'POST') {

        //Validation initialization.
        $name_errors = [];
        $email_errors = [];
        $password_errors = [];

        //Name validation.
        if (!isset($_POST['name']) || empty($_POST['name'])) {
            $name_errors['empty'] = "Please enter your name.";
        };

        if (strlen($_POST['name']) < 1) {
            $name_errors['min_size'] = "Your name must be greater than 1 character.";
        };
    
        if (strlen($_POST['name']) > 30) {
            $name_errors['max_size'] = "Your name must be less than 30 characters.";
        };
    
        if (preg_match('/[^A-Za-z]/', $_POST['name'])) {
            $name_errors['special_characters'] = "Your name cannot contain any special characters, numbers or spaces.";
        };

        //Email validation.
        if (!isset($_POST['email']) || empty($_POST['email'])) {
            $email_errors['empty'] = "Please enter your email address.";
        };

        if (strlen($_POST['email']) < 3) {
            $email_errors['min_size'] = "Your email address must be greater than 3 characters.";
        };
    
        if (strlen($_POST['email']) > 320) {
            $email_errors['max_size'] = "Your email address must be less than 320 characters.";
        };
    
        if (!empty($_POST['email'])) {
            $sanitized_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            if (!filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)) {
                $email_errors['invalid'] = "This email address is not valid.";
            }
        };

        //Check if the email is unique within the USER class
        if (\classes\models\user\User::isEmailUnique($sanitized_email) == false) {
            $email_errors['non_unique'] = "This email address is already in use.";
        };

        //Password validation.
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            $password_errors['empty'] = "Please enter a password.";
        };

        if (strlen($_POST['password']) < 8) {
            $password_errors['min_size'] = "Password must be greater than 8 characters.";
        };

        if (strlen($_POST['password']) > 128) {
            $password_errors['min_size'] = "Password must be less than 128.";
        };

        if (preg_match('/[^A-Za-z\d@$!%*?&;:]/', $_POST['password'])) {
            $password_errors['invalid_characters'] = "Password can only contain letters, numbers and @$!%*?&;: characters.";
        };

        if (!preg_match('/\d+/', $_POST['password'])) {
            $password_errors['number'] = "Password must contain at least 1 number.";
        };

        if (!preg_match('/[A-Z]+/', $_POST['password'])) {
            $password_errors['uppercase'] = "Password must contain at least 1 uppercase letter.";
        };

        if (!preg_match('/[a-z]+/', $_POST['password'])) {
            $password_errors['lowercase'] = "Password must contain at least 1 lowercase letter.";
        };

        if (!preg_match('/[@$!%*?&;:]/', $_POST['password'])) {
            $password_errors['special_characters'] = "Password must contain at least 1 special character: @$!%*?&;:";
        };

        if ($_POST['password'] != $_POST['confirm-password']) {
            $password_errors['no_match'] = "Password does not match.";
        };

        //Check what errors there are and assign them to a session for error alerts in form then kill script, otherwise carry on.
        if(!empty($empty_errors) || !empty($name_errors) || !empty($email_errors) || !empty($password_errors)) {

            session_start();

            if(!empty($name_errors)) {
                $_SESSION['name_errors'] = $name_errors;
            };

            if(!empty($email_errors)) {
                $_SESSION['email_errors'] = $email_errors;
            };

            if(!empty($password_errors)) {
                $_SESSION['password_errors'] = $password_errors;
            };

            //Store the previous values of the name and email input to session to resend to user so they don't have to retype.
            $_SESSION['saved_values']['name'] = $_POST['name'];
            $_SESSION['saved_values']['email'] = $_POST['email'];

            header('Location: /user/register');
            die();
        };

        //Password hashing
        $name = $_POST['name'];
        $email = $sanitized_email;

        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $isAdmin = false;

        $user = new \classes\models\user\User($name, $email, $hashed_password, $isAdmin);
        $result = $user->store();

        if ($result === false) {
            session_start();

            //Could create a small database for the developer to look into errors as the larger the site gets, the more common errors there will be.
            //Error codes could be quite useful for general debugging and figuring out why something wont work without displaying it to the user directly.
            $_SESSION['developer_errors'][] = "Something went wrong please try again or contact the site administrator. Error code: HbqpKoW8L3";

            header('Location: /user/register');
            die();
        }

        

        session_start();
        $_SESSION['success'] = true;
        header('Location: /user/register');
        die();
    }

    else {
        return "Invalid request: " . $_SERVER['REQUEST_METHOD'];
    };