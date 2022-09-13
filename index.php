<?php

//Auto loading classes to create a router object.
require_once('vendor/autoload.php');

//Get the initialization script to create the database and tables. It will delete itself after it has run.
if (file_exists('init.php')) {
    include_once('init.php');
}

$router = new classes\Router();

//Standard & Basic routing
$router->get('/', function() {
    session_start();
    require_once('controllers/index.php');
});

//404 handler
$router->notFound(function() {
    require_once('views/404.php');
});

//User routes
require_once('routes/user.php');
require_once('routes/article.php');
require_once('routes/admin.php');
require_once('routes/category.php');
require_once('routes/image.php');

//Run the router after everything has processed
$router->run();
