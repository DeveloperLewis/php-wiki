<?php
/* @var $router */

$router->get('/category/new', function () {
    require_once('controllers/category/category_new.php');
});

$router->post('/category/new', function () {
    require_once('controllers/category/category_new.php');
});

$router->get('/category/edit', function () {
    require_once('controllers/category/category_edit.php');
});

$router->post('/category/edit', function () {
    require_once('controllers/category/category_edit.php');
});

$router->post('/category/delete', function () {
    require_once('controllers/category/category_delete.php');
});