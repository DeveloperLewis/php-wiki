<?php
session_start();
if(isset($_SESSION['uid'])) {
    if (\classes\models\user\User::isAdmin($_SESSION['uid'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $article_id = $_GET['id'];

            //If the article could not be found via the ID
            if (!$article = \classes\models\article\Article::getSpecified($article_id)) {
                //some error to send through to articles panel via sessions

                header('Location: /admin/articles?amount=0');
                die();
            }
            require_once('views/article/edit.php');
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

                header('Location: /article/edit?id=' . $_POST['article_id']);
                die();
            }

            //Start assigning post requests to variables
            $title = $_POST['title'];
            $body = $_POST['body'];


            $original_author = $_SESSION['uid'];
            $shared = $_POST['shared'];

            //Update the last edited date for the article
            $timezone = 'Europe/London';
            $timestamp = time();
            $dt = new DateTime("now", new DateTimeZone($timezone));
            $dt->setTimestamp($timestamp);
            $last_edited_date = $dt->format('d.m.Y H:i:s');

            $last_edited_by_author = $original_author;

            if (!empty($_POST['notes'])) {
                $notes = $_POST['notes'];
            } else {
                $notes = null;
            }



            if (!empty($_POST['category'])) {
                $categories = $_POST['category'];
            } else {
                $categories = null;
            }


            //Sanitizing the HTML for the body as it can contain dangerous HTML.
            $purified_body = $validation->purifyHtml($body);

            //If the article failed to store, create an error
            if (!\classes\models\article\Article::update($title, $purified_body, $original_author, $shared, $notes, $categories, $_POST['article_id'], $last_edited_date)) {
                session_start();
                $_SESSION['store_error'] = "There was an error storing the article in the database, please try again.";
                header('Location: /article/edit?id=' . $_POST['article_id']);
                die();
            }

            //Otherwise create a session for the user and let them know the article was stored successfully
            session_start();
            $_SESSION['success'] = "The article was successfully edited.";
            header('Location: /admin/articles?amount=0');
            die();
        }
    }
}

else {
    header('Location: /');
    die();
}
