<?php
/* @var $router */

$router->get('/article', function(array $params) {
    require_once('controllers/article/article_view.php');
});



$router->get('/article/new', function() {
    require_once('controllers/article/article_new.php');
});

$router->post('/article/new', function() {
    require_once('controllers/article/article_new.php');
});



$router->get('/article/edit', function() {
    require_once('controllers/article/article_edit.php');
});

$router->post('/article/edit', function() {
    require_once('controllers/article/article_edit.php');
});



$router->post('/article/delete', function() {
    require_once('controllers/article/article_delete.php');
});

$router->post('/article/preview', function () {
    require_once('controllers/article/article_preview.php');
});

$router->get('/article/search', function($params) {
   require_once('controllers/article/article_search.php');
});