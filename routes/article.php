<?php
/* @var $router */

$router->get('/article', function(array $params) {
    require('controllers/article/article_view.php');
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

$router->get('/article/preview', function (array $params) {
    require('controllers/article/article_preview.php');
});