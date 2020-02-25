<?php declare(strict_types = 1);

namespace Framework;

require __DIR__ .'/../vendor/autoload.php';

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;

/**
* Error Handler Register basic
*/
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

/* 
* Router register Basic
*/
$dispatcher = \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $r) {
    $routes = require __DIR__ . '/routes.php';
    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
});

/**
* register HTTP symfony 
*/
$request = Request::createFromGlobals();

/*
* register Depency Injection 
*/
require __DIR__ . '/dependency.php';

/*
* Dispatch Class
*/
$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());
switch ($routeInfo[0]) {
    case \FastRoute\Dispatcher::NOT_FOUND:
	   Response::create("404 Not Found", Response::HTTP_NOT_FOUND)->prepare($request)->send();
        break;
    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
	   Response::create("405 Method Not Allowed", Response::HTTP_METHOD_NOT_ALLOWED)->prepare($request)->send();
        break;
    case \FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1][0];
        $method = $routeInfo[1][1];
        if( $request->getMethod() == "GET" ){
            $vars = $routeInfo[2];
        }else{
            $vars = $request->request->all();
        }
        $class = $dice->create($handler);
        $response = $class->$method($vars);
        if ($response instanceof Response) {
                $response->prepare($request)->send();
            }
        break;
}