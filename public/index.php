<?php
declare(strict_types=1);

// 1) Autoloader
require __DIR__ . '/../vendor/autoload.php';

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use Kpzsproductions\Lipus\Controllers\HomeController;
use Kpzsproductions\Lipus\Controllers\RulesController;
use Kpzsproductions\Lipus\Controllers\GalleryController;
use Kpzsproductions\Lipus\Controllers\AdminController;
use Symfony\Component\HttpFoundation\Request;   
use Symfony\Component\HttpFoundation\Response;

// 2) Pobierz Request (jeśli używasz HttpFoundation)
$request = Request::createFromGlobals();

// 3) Zdefiniuj trasy
$dispatcher = simpleDispatcher(function(RouteCollector $r) {
    $r->addRoute('GET', '/', [HomeController::class, 'index']);
    $r->addRoute('GET', '/rules', [RulesController::class, 'index']);
    $r->addRoute('GET', '/gallery', [GalleryController::class, 'index']);
    // Dodajemy nową trasę dla API Facebooka
    $r->addRoute('GET', '/api/facebook/posts', [GalleryController::class, 'getFacebookPosts']);
    
    // Admin routes
    $r->addRoute('GET', '/admin/login', [AdminController::class, 'loginPage']);
    $r->addRoute('POST', '/admin/login', [AdminController::class, 'login']);
    $r->addRoute('GET', '/admin/panel', [AdminController::class, 'panel']);
    $r->addRoute('GET', '/admin/logout', [AdminController::class, 'logout']);
    $r->addRoute('GET', '/admin/posts', [AdminController::class, 'getPosts']);
    $r->addRoute('POST', '/admin/posts/add', [AdminController::class, 'addPost']);
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
