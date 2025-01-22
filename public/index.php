<?php

require '../helpers.php';
require basePath('vendor/autoload.php');

use Framework\Router;

// require basePath('Framework/Database.php');
// require basePath('Framework/Router.php');

// spl_autoload_register(function ($class) {
//     $path = basePath("Framework/$class.php");
//     if (file_exists($path)) {
//         require $path;
//     }
// });

//On recupere le currrent uri et methode http
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

//On instancie un router
$router = new Router();

//On crée des routes
require basePath('routes.php');

//On fait le routage
$router->route($uri, $method);
