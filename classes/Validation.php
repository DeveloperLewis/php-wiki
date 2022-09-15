<?php

namespace classes;

class Validation
{
    //Article Title validation.
    function title(string $title): array|bool {
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

        if (!empty($title_errors)) {
            return $title_errors;
        }

        return true;
    }

    //Article Body validation.
    function body(string $body): array|bool {
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

        if (preg_match('/[^a-zA-Z\d#\-=.,:;\/*@!\[\]()_`<>\s%"]/', $body)) {
            $body_errors['special_chars'] = "The body can only contain letters, numbers and these
            special characters: #-=.,:;/_*@![]()`<>% as well as quotation marks.";
        }

        if (!empty($body_errors)) {
            return $body_errors;
        }

        return true;
    }

    //Article Notes validation.
    function notes(string $notes): array|bool {
        $notes_errors = [];

        //Validation Rules.
        if (strlen($notes) > 10000) {
            $notes_errors['max_size'] = "The notes must be less than 10000 characters. You're currently at: " . strlen($notes) . ".";
        }

        if (preg_match('/[^A-z\d!?:\-.,\s]/', $notes)) {
            $notes_errors['special_chars'] = "The notes can only contain
             letters, numbers and the following special characters: !?:-.,";
        }

        if (!empty($notes_errors)) {
            return $notes_errors;
        }

        return true;
    }

    //Category Name validation
    function category(string $category): array|bool {
        $category_errors = [];

        //Validation Rules.
        if (empty($category)) {
            $category_errors['empty'] = "The category cannot be empty!";
        }

        if (strlen($category) < 4) {
            $category_errors['min_size'] = "The category must be greater than 3 character. You're currently at: " . strlen($category) . ".";
        }

        if (strlen($category) > 25) {
            $category_errors['max_size'] = "The category must be less than 25 characters. You're currently at: " . strlen($category) . ".";
        }

        if (preg_match('/[^a-zA-Z\- ]/', $category)) {
            $category_errors['special_chars'] = "The category can only contain
             letters and the character: -";
        }

        if (!\classes\models\article\Category::isCategoryUnique($category)) {
            $category_errors['not_unique'] = "This category already exists, please try another name.";
        }

        if (!empty($category_errors)) {
            return $category_errors;
        }

        return true;
    }

    //Sanitize any html that is given.
    function purifyHtml(string $string): string {
        //Configuration rules for html purifier
        $config = \HTMLPurifier_Config::createDefault();
        $purifier = new \HTMLPurifier($config);
        $config->set('HTML.AllowedAttributes', 'a.href');
        $config->set('HTML.AllowedAttributes', 'src, height, width, alt');

        //Sanitized html is returned
        return $purifier->purify($string);
    }
}
