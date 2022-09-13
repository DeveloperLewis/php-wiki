<?php
session_start();
//Check if the route was a GET method and do the following:
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_SESSION['uid'])) {
        require_once('views/user/change_password.php');
    } else {
        header('Location: /');
        die();
    }
}

//Check if the route was a POST method and do the following:
elseif($_SERVER['REQUEST_METHOD'] == 'POST') {
    $old_password = $_POST['old-password'];
    $new_password = $_POST['new-password'];
    $repeated_new_password = $_POST['repeated-new-password'];

    if (!\classes\models\user\User::verifyPassword($_SESSION['uid'], $old_password)) {
        $_SESSION['password_errors'] = ['Password is incorrect, please try again.'];
        header('Location: /user/change-password');
        die();
    }

    $password_errors = [];

    //Password validation.
    if (!isset($new_password) || empty($new_password)) {
        $password_errors['empty'] = "Please enter a password.";
    };

    if (strlen($new_password) < 8) {
        $password_errors['min_size'] = "Password must be greater than 8 characters.";
    };

    if (strlen($new_password) > 128) {
        $password_errors['min_size'] = "Password must be less than 128.";
    };

    if (preg_match('/[^A-Za-z\d@$!%*?&;:]/', $new_password)) {
        $password_errors['invalid_characters'] = "Password can only contain letters, numbers and @$!%*?&;: characters.";
    };

    if (!preg_match('/\d+/', $new_password)) {
        $password_errors['number'] = "Password must contain at least 1 number.";
    };

    if (!preg_match('/[A-Z]+/', $new_password)) {
        $password_errors['uppercase'] = "Password must contain at least 1 uppercase letter.";
    };

    if (!preg_match('/[a-z]+/', $new_password)) {
        $password_errors['lowercase'] = "Password must contain at least 1 lowercase letter.";
    };

    if (!preg_match('/[@$!%*?&;:]/', $new_password)) {
        $password_errors['special_characters'] = "Password must contain at least 1 special character: @$!%*?&;:";
    };

    if ($new_password != $repeated_new_password) {
        $password_errors['no_match'] = "Password does not match.";
    };

    if(!empty($password_errors)) {
        session_start();
        $_SESSION['password_errors'] = $password_errors;
        header('Location: /user/change-password');
        die();
    };

    if (!\classes\models\user\User::changePassword($_SESSION['uid'], $old_password, $new_password)) {
        session_start();
        $_SESSION['password_errors'] = ['Failed to change password, please try again'];
        header('Location: /user/change-password');
        die();
    }

    $_SESSION['password_changed'] = "Password was successfully changed";
    header('Location: /admin/dashboard');
    die();
}