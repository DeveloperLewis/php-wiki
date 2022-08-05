<?php

namespace classes;

class Validation
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

    function body(string $body): array|bool {

        //Initialize the array.
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

        if($body != strip_tags($body)) {
            $body_errors['html'] = "You cannot use HTML, please use markdown instead. Here is a guide on how to use it: https://www.markdownguide.org/basic-syntax/";
        }

        if (preg_match('/[^a-zA-Z\d#\-=.,:;/_*@!\[\]\(\)`<>]/', $body)) {
            $body_errors['special_chars'] = "The body can only contain letters, numbers and these
            special characters: #-=.,:;/_*@![]()`<>";
        }


        //Return the array if there are any errors.
        if (!empty($body_errors)) {
            return $body_errors;
        }

        //Return true if there aren't any errors.
        return true;
    }

    function notes(string $notes): array|bool {

        //Initialize the array.
        $notes_errors = [];

        //Validation Rules.
        if (empty($notes)) {
            $notes_errors['empty'] = "The notes content cannot be empty!";
        }

        if (strlen($notes < 50)) {
            $notes_errors['min_size'] = "The notes must contain more than 100 characters. You're currently at: " . strlen($notes) . ".";
        }

        if (strlen($notes > 10000)) {
            $notes_errors['max_size'] = "The notes must be less than 10000 characters. You're currently at: " . strlen($notes) . ".";
        }

        if (preg_match('/[^A-z\d!?:\-.,]/', $notes)) {
            $notes_errors['special_chars'] = "The notes can only contain
             letters, numbers and the following special characters: !?:-.,";
        }

        //Return the array if there are any errors.
        if (!empty($notes_errors)) {
            return $notes_errors;
        }

        //Return true if there aren't any errors.
        return true;

    }

    //TODO: Sanitize the markdown and display it as html or something

    //TODO: Validate catagories;

}
