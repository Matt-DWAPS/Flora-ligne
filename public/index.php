<?php

require '../Autoloader.php'; 
\App\Autoloader::register();

//require '../Framework/Router.php';
use App\Framework\Router;

$router = new Router();
$router->routeRequest();