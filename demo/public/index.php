<?php

session_start();

use Core\Router;
use Core\Session;
use Core\ValidationException;
const BASE_PATH = __DIR__.'/../';

require BASE_PATH.'Core/functions.php';

//session_start();

require BASE_PATH . '/vendor/autoload.php';

spl_autoload_register(function ($class) {
    // Core\Database

    // DIRECTORY_SEPARATOR ineffective
    $class = str_replace('\\', '/', $class);

    require base_path("{$class}.php");
});

require base_path('bootstrap.php');

$router = new Router();

$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    redirect($router->previousUrl());
}

Session::unflash();
