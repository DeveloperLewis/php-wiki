<?php
/* @var $router */


$router->get('/admin/dashboard', function() {
    require_once('controllers/admin/admin_dashboard.php');
});

$router->get('/admin/articles', function() {
    require_once('controllers/admin/admin_dashboard.php');
});