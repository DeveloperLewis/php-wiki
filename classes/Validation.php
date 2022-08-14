<?php

namespace classes;

class Validation
{
    //Validation methods for elements of the wiki
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

        if (preg_match('/[^A-z\d!?:\-., ]/', $title)) {
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

        if (strlen($body) < 100) {
            $body_errors['min_size'] = "The body must be more than 100 characters. You're currently at: " . strlen($body) . ".";
        }

        if (strlen($body) > 5000000) {
            $body_errors['max_size'] = "The body must be less than 5000000 characters. You're currently at: " . strlen($body) . ".";
        }

        if (preg_match('/[^a-zA-Z\d#\-=.,:;\/*@!\[\]()`<>\s]/', $body)) {
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

        if (strlen($notes) > 10000) {
            $notes_errors['max_size'] = "The notes must be less than 10000 characters. You're currently at: " . strlen($notes) . ".";
        }

        if (preg_match('/[^A-z\d!?:\-.,\s]/', $notes)) {
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

    function category(string $category): array|bool {

        //Initialize the array.
        $category_errors = [];

        //Validation Rules.
        if (empty($category)) {
            $category_errors = "The category cannot be empty!";
        }

        if (strlen($category) < 4) {
            $category_errors['min_size'] = "The category must be greater than 3 character. You're currently at: " . strlen($category) . ".";
        }

        if (strlen($category) > 25) {
            $category_errors['min_size'] = "The category must be less than 25 characters. You're currently at: " . strlen($category) . ".";
        }

        if (preg_match('/[^a-zA-Z\- ]/', $category)) {
            $category_errors['special_chars'] = "The category can only contain
             letters and the character: -";
        }

        //Return the array if there are any errors.
        if (!empty($category_errors)) {
            return $category_errors;
        }

        //Return true if there aren't any errors.
        return true;
    }

    //Cleans up the html that is dangerous and untrusted with html purifier.
    function purifyHtml(string $string): string {
        $config = \HTMLPurifier_config::createDefault();
        $purifier = new \HTMLPurifier($config);

        return $purifier->purify($string);
    }
}
