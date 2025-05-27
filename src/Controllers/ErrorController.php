<?php
namespace Kpzsproductions\Lipus\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ErrorController
{
    public function notFound(Request $request): Response
    {
        $content = $this->render(__DIR__ . '/../Views/404.php');
        return new Response($content, 404);
    }

    private function render(string $path, array $vars = []): string
    {
        extract($vars);
        ob_start();
        include $path;
        return ob_get_clean();
    }
} 