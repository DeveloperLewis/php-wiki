<?php
/* @var $router */

$router->get('/image/new', function() {
    require_once('controllers/image/new.php');
});

$router->post('/image/new', function() {
    require_once('controllers/image/new.php');
});