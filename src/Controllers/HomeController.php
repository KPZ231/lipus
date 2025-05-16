<?php
namespace Kpzsproductions\Lipus\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    public function index(Request $request): Response
    {
        // Możesz załadować prosty helper do widoków
        $content = $this->render(__DIR__ . '/../Views/home.php', [
            'title' => 'Witaj w mojej aplikacji!',
            'user'  => 'Jan Kowalski',
        ]);
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
