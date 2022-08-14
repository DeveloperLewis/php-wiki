<?php
    session_start();

    //Check if the user is logged in before the following:
    if (isset($_SESSION['uid'])) {
        session_destroy();
        header('Location: /');
        die();
    } else {
        header('Location: /');
        die();
    }

