<?php
session_start();
if(isset($_SESSION['uid'])) {
    if (\classes\models\user\User::isAdmin($_SESSION['uid'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require_once('views/article/new.php');
        }

        elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Create validation object and run the validation methods and assign results to variables
            $validation = new \classes\Validation();
            $validation_result_for_title = $validation->title($_POST['title']);
            $validation_result_for_body = $validation->body(($_POST['body']));
            $validation_result_for_notes = $validation->notes($_POST['notes']);

            //Check if any errors returned and start sessions for them to display
            if (is_array($validation_result_for_title)) {
                session_start();
                $_SESSION['title_errors'] = $validation_result_for_title;
            }

            if (is_array($validation_result_for_body)) {
                session_start();
                $_SESSION['body_errors'] = $validation_result_for_body;
            }

            if (is_array($validation_result_for_notes)) {
                session_start();
                $_SESSION['notes_errors'] = $validation_result_for_notes;
            }

            //If any result variables are arrays, then get the previous POST array items and send them back for ease of user experience.
            if (isset($_SESSION['notes_errors']) || isset($_SESSION['title_errors']) || isset($_SESSION['body_errors'])) {
                $_SESSION['title_previous'] = $_POST['title'];
                $_SESSION['body_previous'] = $_POST['body'];
                $_SESSION['notes_previous'] = $_POST['notes'];

                header('Location: /article/new');
                die();
            }

            //Start assigning post requests to variables
            $title = $_POST['title'];
            $body = $_POST['body'];

            if (isset($_POST['notes'])) {
                if (!empty($_POST['notes'])) {
                    $notes = $_POST['notes'];
                }
            }

            $original_author = $_SESSION['uid'];
            $shared = $_POST['shared'];

            //Set the creation and last edited date upon creation
            $timezone = 'Europe/London';
            $timestamp = time();
            $dt = new DateTime("now", new DateTimeZone($timezone)); //first argument "must" be a string
            $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
            $creation_date = $dt->format('d.m.Y H:i:s');
            $last_edited_date = $dt->format('d.m.Y H:i:s');



            $last_edited_by_author = $original_author;

            if (isset($_POST['categories'])) {
                if (!empty($_POST['categories'])) {
                    $categories = $_POST['categories'];
                }
            }

            //Sanitizing the HTML for the body as it can contain dangerous HTML.
            $purified_body = $validation->purifyHtml($body);

            //Required parameters to create a bare minimum article.
            $article = new \classes\models\article\Article($title, $purified_body,
                $original_author, $shared, $creation_date, $last_edited_date);

            //If these post items aren't empty, assign them to the object properties
            if (!empty($_POST['notes'])) {
                $article->setInitNotes($_POST['notes']);
            }

            if (!empty($_POST['category'])) {
                $article->setInitCategories($_POST['category']);
            }

            //If the article failed to store, create an error
            if (!$article->store()) {
                session_start();
                $_SESSION['store_error'] = "There was an error storing the article in the database, please try again.";
                header('Location: /article/new');
                die();
            }

            //Otherwise create a session for the user and let them know the article was stored successfully
            session_start();
            $_SESSION['success'] = "The article was successfully stored in the database.";
            header('Location: /admin/articles');
            die();
        }
        else {
            header('Location: /');
            die();
        }
    }
}

else {
    header('Location: /');
    die();
}