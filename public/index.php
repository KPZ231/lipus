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
use Kpzsproductions\Lipus\Controllers\ErrorController;
use Kpzsproductions\Lipus\Controllers\PrivacyController;
use Kpzsproductions\Lipus\Controllers\SitemapController;
use Kpzsproductions\Lipus\Controllers\PostsController;
use Symfony\Component\HttpFoundation\Request;   
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

// 2) Pobierz Request
$request = Request::createFromGlobals();
$path = $request->getPathInfo();

// Obsługa plików statycznych z folderu uploads
if (strpos($path, '/uploads/') === 0) {
    $filePath = __DIR__ . $path;
    if (file_exists($filePath) && is_file($filePath)) {
        // Określ typ MIME
        $mimeType = mime_content_type($filePath) ?: 'application/octet-stream';
        
        $response = new BinaryFileResponse($filePath);
        $response->headers->set('Content-Type', $mimeType);
        $response->send();
        exit;
    }
}

// 3) Zdefiniuj trasy
$dispatcher = simpleDispatcher(function(RouteCollector $r) {
    $r->addRoute('GET', '/', [HomeController::class, 'index']);
    $r->addRoute('GET', '/rules', [RulesController::class, 'index']);
    $r->addRoute('GET', '/gallery', [GalleryController::class, 'index']);
    // Dodajemy nową trasę dla API Facebooka
    $r->addRoute('GET', '/api/facebook/posts', [GalleryController::class, 'getFacebookPosts']);
    
    // Dodajemy trasę dla postów
    $r->addRoute('GET', '/posts', [PostsController::class, 'index']);
    
    // Dodajemy trasę dla polityki prywatności
    $r->addRoute('GET', '/privacy-policy', [PrivacyController::class, 'index']);
    
    // Dodajemy trasę dla sitemap.xml
    $r->addRoute('GET', '/sitemap.xml', [SitemapController::class, 'index']);
    
    // Admin routes
    $r->addRoute('GET', '/admin/login', [AdminController::class, 'loginPage']);
    $r->addRoute('POST', '/admin/login', [AdminController::class, 'login']);
    $r->addRoute('GET', '/admin/panel', [AdminController::class, 'panel']);
    $r->addRoute('GET', '/admin/logout', [AdminController::class, 'logout']);
    $r->addRoute('GET', '/admin/get-posts', [AdminController::class, 'getPosts']);
    $r->addRoute('POST', '/admin/add-post', [AdminController::class, 'addPost']);
    $r->addRoute('POST', '/admin/delete-post', [AdminController::class, 'deletePost']);
    
    // New admin routes for regular posts, gallery posts, and prices
    $r->addRoute('POST', '/admin/add-regular-post', [AdminController::class, 'addRegularPost']);
    $r->addRoute('POST', '/admin/add-gallery-post', [AdminController::class, 'addGalleryPost']);
    $r->addRoute('GET', '/admin/get-prices', [AdminController::class, 'getCurrentPrices']);
    $r->addRoute('POST', '/admin/update-prices', [AdminController::class, 'updatePrices']);
});

// 4) Dispatch
$routeInfo = $dispatcher->dispatch($request->getMethod(), $path);
switch ($routeInfo[0]) {
    case \FastRoute\Dispatcher::NOT_FOUND:
        // Zamiana standardowej odpowiedzi 404 na kontroler ErrorController
        $controller = new ErrorController();
        $response = $controller->notFound($request);
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
