<?php
namespace Kpzsproductions\Lipus\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostsController
{
    private $postsDirectory;

    public function __construct()
    {
        $this->postsDirectory = dirname(dirname(__DIR__)) . '/public/uploads/posts';
    }

    public function index(Request $request): Response
    {
        // Load all posts
        $posts = $this->loadPosts();
        
        // Sort posts by importance (important first) and then by created_at (newest first)
        usort($posts, function($a, $b) {
            // First compare by importance
            if (($a['important'] ?? false) && !($b['important'] ?? false)) return -1;
            if (!($a['important'] ?? false) && ($b['important'] ?? false)) return 1;
            
            // If equal importance, compare by date (newest first)
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });
        
        return new Response($this->render(__DIR__ . '/../Views/posts.php', [
            'posts' => $posts
        ]));
    }

    private function loadPosts(): array
    {
        $postsFile = $this->postsDirectory . '/posts.json';
        if (!file_exists($postsFile)) {
            return [];
        }
        return json_decode(file_get_contents($postsFile), true) ?? [];
    }

    private function render(string $path, array $vars = []): string
    {
        extract($vars);
        ob_start();
        include $path;
        return ob_get_clean();
    }
} 