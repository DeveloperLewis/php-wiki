<?php
/* @var $router */

$router->get('/category/new', function () {
    require_once('controllers/category/category_new.php');
});

$router->post('/category/new', function () {
    require_once('controllers/category/category_new.php');
});



$router->post('/category/delete', function () {
    require_once('controllers/category/category_delete.php');
});