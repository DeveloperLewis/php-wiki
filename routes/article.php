<?php

    /* @var $router */

$router->get('/article', function() {
    echo "hi";
});

$router->get('/article/new', function() {
    require('controllers/article/article_new.php');
});

$router->post('/article/new', function() {
    require('controllers/article/article_new.php');
});

$router->get('/article/edit', function() {
    require('controllers/article/article_edit.php');
});

$router->post('/article/edit', function() {
    require('controllers/article/article_edit.php');
});

$router->post('/article/delete', function() {
    require('controllers/article/article_delete.php');
});