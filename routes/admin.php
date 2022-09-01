<?php
/* @var $router */


$router->get('/admin/dashboard', function() {
    require_once('controllers/admin/admin_dashboard.php');
});

$router->get('/admin/articles', function() {
    require_once('controllers/admin/admin_articles.php');
});

$router->get('/admin/categories', function() {
    require_once('controllers/admin/admin_categories.php');
});

$router->get('/admin/images', function() {
    require_once('controllers/admin/admin_images.php');
});

$router->get('/admin/users', function() {
    require_once('controllers/admin/admin_users.php');
});
