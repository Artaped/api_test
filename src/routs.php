<?php
define('ROOT', dirname(__FILE__));
$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->get('/', function () {
        echo "main page";
    });
    //api user
    $r->addRoute('POST', '/api/registration', "App\controllers\UserController/create");
    //--------------------------------------------

    //api product
    $r->addRoute('GET', '/api/product/{id}', "App\controllers\ProductController/getOneProductById");
    $r->addRoute('GET', '/api/product', "App\controllers\ProductController/all");
    $r->addRoute('GET', '/api/product/{id}/category', "App\controllers\ProductController/getProductInCategory");
    $r->addRoute('POST', '/api/product', "App\controllers\ProductController/create");
    $r->addRoute('PUT', '/api/product', "App\controllers\ProductController/update");
    $r->addRoute('DELETE', '/api/product', "App\controllers\ProductController/delete");
    //api category
    $r->addRoute('GET', '/api/category', "App\controllers\CategoryController/all");
    $r->addRoute('POST', '/api/category', "App\controllers\CategoryController/create");
    $r->addRoute('PUT', '/api/category', "App\controllers\CategoryController/update");
    $r->addRoute('DELETE', '/api/category', "App\controllers\CategoryController/delete");
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo "404 Not Found";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo "405 Method Not Allowed";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        //call_user_func($handler, $vars);
        list($class, $method) = explode("/", $handler, 2);
        call_user_func_array(array(new $class, $method), $vars);
        break;
}