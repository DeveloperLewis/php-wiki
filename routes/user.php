<?php
/* @var $router */


$router->get('/user/register', function() {
    require_once('controllers/user/user_register.php');
});

$router->post('/user/register', function() {
    require_once('controllers/user/user_register.php');
});



$router->get('/user/login', function() {
    require_once('controllers/user/user_login.php');
});

$router->post('/user/login', function() {
    require_once('controllers/user/user_login.php');
});



$router->get('/user/logout', function() {
    require_once('controllers/user/user_logout.php');
});