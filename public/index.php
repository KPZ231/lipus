<?php
declare(strict_types=1);

// 1) Autoloader
require __DIR__ . '/../vendor/autoload.php';

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use Kpzsproductions\Lipus\Controllers\HomeController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// 2) Pobierz Request (jeśli używasz HttpFoundation)
$request = Request::createFromGlobals();

// 3) Zdefiniuj trasy
$dispatcher = simpleDispatcher(function(RouteCollector $r) {
    $r->addRoute('GET', '/', [HomeController::class, 'index']);
    // możesz dodać inne, np. $r->addRoute('POST', '/user', [UserController::class, 'store']);
});

// 4) Dispatch
$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());
switch ($routeInfo[0]) {
    case \FastRoute\Dispatcher::NOT_FOUND:
        $response = new Response('404 Not Found', 404);
        break;
    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $response = new Response('405 Method Not Allowed', 405);
        break;
    case \FastRoute\Dispatcher::FOUND:
        [$class, $method] = $routeInfo[1];
        $vars = $routeInfo[2]; // np. parametry z URI
        $controller = new $class();
        // wywołaj kontroler
        $response = call_user_func_array([$controller, $method], [$request, $vars]);
        break;
}

// 5) Wyślij response
if ($response instanceof Response) {
    $response->send();
} else {
    // jeśli kontroler zwrócił string
    echo $response;
}
