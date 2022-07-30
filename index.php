<?php

//Autoloading classes to create a router object.
require_once('vendor/autoload.php');

//Get the initalization script to create the database and tables. It will delete itself after it has ran.
if (file_exists('init.php')) {
    include_once('init.php');
}

$router = new classes\Router();

//Standard & Basic routing
$router->get('/', function() {
    session_start();
    require_once('views/index.php');
});

$router->notFound(function() {
    require_once('views/404.php');
});

//User routes
require_once('routes/user.php');
require_once('routes/article.php');
require_once('routes/admin.php');

$router->run();
