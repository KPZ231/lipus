<?php
namespace Kpzsproductions\Lipus\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class GalleryController
{
    private $postsDirectory;

    public function __construct()
    {
        $this->postsDirectory = dirname(dirname(dirname(__FILE__))) . '/public/uploads/posts';
        if (!file_exists($this->postsDirectory)) {
            mkdir($this->postsDirectory, 0777, true);
        }
    }

    public function index(Request $request): Response
    {
        try {
            $content = $this->render(__DIR__ . '/../Views/gallery.php', [
                'posts' => $this->getLocalPosts()
            ]);
            return new Response($content);
        } catch (\Exception $e) {
            error_log('Gallery view error: ' . $e->getMessage());
            return new Response('Error loading gallery: ' . $e->getMessage(), 500);
        }
    }

    public function getLocalPosts(): array
    {
        try {
            $posts = [];
            $postsData = glob($this->postsDirectory . '/*.json');
            
            foreach ($postsData as $postFile) {
                $postContent = file_get_contents($postFile);
                if ($postContent === false) {
                    continue;
                }
                
                $post = json_decode($postContent, true);
                if (json_last_error() === JSON_ERROR_NONE && isset($post['id'])) {
                    // Verify that the image file exists
                    $imagePath = $this->postsDirectory . '/' . $post['id'] . '.jpg';
                    if (file_exists($imagePath)) {
                        $post['image_url'] = '/uploads/posts/' . $post['id'] . '.jpg';
                        $posts[] = $post;
                    }
                }
            }
            
            // Sort posts by date (newest first)
            usort($posts, function($a, $b) {
                return strtotime($b['created_at'] ?? '0') - strtotime($a['created_at'] ?? '0');
            });
            
            return $posts;
        } catch (\Exception $e) {
            error_log('Error getting local posts: ' . $e->getMessage());
            return [];
        }
    }

    private function render(string $path, array $vars = []): string
    {
        extract($vars);
        ob_start();
        include $path;
        return ob_get_clean();
    }
} 