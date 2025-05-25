<?php
namespace Kpzsproductions\Lipus\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RulesController
{
    public function index(Request $request): Response
    {
        $content = $this->render(__DIR__ . '/../Views/rules.php');
        return new Response($content);
    }

    private function render(string $path, array $vars = []): string
    {
        extract($vars);
        ob_start();
        include $path;
        return ob_get_clean();
    }
} 