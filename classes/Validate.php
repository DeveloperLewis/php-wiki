<?php

namespace classes;

class Validate
{
    function title(string $title): array|bool {

        //Initialize the array.
        $title_errors = [];


        //Validation rules.
        if (empty($title)) {
            $title_errors['empty'] = "The title cannot be empty.";
        }

        if (strlen($title) < 10) {
            $title_errors['min_size'] = "The title cannot be less than 10 characters. You're currently at: " . strlen($title) . ".";
        }

        if (strlen($title) > 300) {
            $title_errors['max_size'] = "The title cannot be more than 300 characters. You're currently at: " . strlen($title) . ".";
        }

        if (preg_match('/[^A-z\d!?:\-.,]/', $title)) {
            $title_errors['special_chars'] = "The title can only contain
             letters, numbers and the following special characters: !?:-.,";
        }


        //Return the array if there are any errors.
        if (!empty($title_errors)) {
            return $title_errors;
        }

        //Return true if there aren't any errors.
        return true;
    }

    //TODO: Finish body validations
    function body(string $body): array|bool {

        $body_errors = [];

        //Validation rules.
        if (empty($body)) {
            $body_errors['empty'] = "The body content cannot be empty!";
        }

        if (strlen($body < 100)) {
            $body_errors['min_size'] = "The body must be more than 100 characters. You're currently at: " . strlen($body) . ".";
        }

        if (strlen($body > 5000000)) {
            $body_errors['max_size'] = "The body must be less than 5000000 characters. You're currently at: " . strlen($body) . ".";
        }


        //TODO: Create the HTML tags that are valid, and other things that might be allowed within the body of an article.

        //Return the array if there are any errors.
        if (!empty($body_errors)) {
            return $body_errors;
        }

        //Return true if there aren't any errors.
        return true;
    }

    //TODO: Create notes validations

}
