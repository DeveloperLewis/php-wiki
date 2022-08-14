<?php
session_start();
if(isset($_SESSION['uid'])) {
    if (\classes\models\user\User::isAdmin($_SESSION['uid'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require_once('views/admin/dashboard.php');
        }

        elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $validation = new \classes\Validation();
            $validation_result_for_title = $validation->title($_POST['title']);
            $validation_result_for_body = $validation->body(($_POST['body']));
            $validation_result_for_notes = $validation->notes($_POST['notes']);

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

            //TODO: Process the errors on the article_new.panel. So they are visible and show what the user entering incorrectly.
            if (isset($_SESSION['notes_errors']) || isset($_SESSION['title_errors']) || isset($_SESSION['body_errors'])) {
                $_SESSION['title_previous'] = $_POST['title'];
                $_SESSION['body_previous'] = $_POST['body'];
                $_SESSION['notes_previous'] = $_POST['notes'];

                header('Location: /article/new');
                die();
            }

            //TODO: Create the class handlers to be able to store the data into the database next.
            $title = $_POST['title'];
            $body = $_POST['body'];

            if (isset($_POST['notes'])) {
                if (!empty($_POST['notes'])) {
                    $notes = $_POST['notes'];
                }
            }

            $original_author = $_SESSION['uid'];
            $shared = $_POST['shared'];

            $date = new DateTime();
            $creation_date = $date->getTimestamp();

            $last_edited_by_author = $original_author;

            if (isset($_POST['categories'])) {
                if (!empty($_POST['categories'])) {
                    $categories = $_POST['categories'];
                }
            }

            //Sanitizing the HTML for the body as it can contain dangerous HTML.
            $purified_body = $validation->purifyHtml($body);

            //Required parameters to create a bare_minimum article.
            $article = new \classes\models\article\Article($title, $purified_body,
                $original_author, $shared, $creation_date);

            if (!$article->storeMinimum()) {
                session_start();
                $_SESSION['store_error'] = "There was an error storing the article in the database, please try again.";
                header('Location: /article/new');
                die();
            }

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