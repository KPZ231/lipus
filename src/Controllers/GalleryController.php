<?php
namespace Kpzsproductions\Lipus\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class GalleryController
{
    private $postsDirectory;
    private $postsFile;

    public function __construct()
    {
        $this->postsDirectory = dirname(dirname(dirname(__FILE__))) . '/public/uploads/posts';
        $this->postsFile = $this->postsDirectory . '/posts.json';
        if (!file_exists($this->postsDirectory)) {
            mkdir($this->postsDirectory, 0777, true);
        }
    }

    public function getCategoryName($category): string
    {
        $categories = [
            'landscape' => 'Krajobraz',
            'fish' => 'Złowione ryby',
            'people' => 'Wędkarze',
            'infrastructure' => 'Infrastruktura'
        ];
        return $categories[$category] ?? 'Inne';
    }

    public function index(Request $request): Response
    {
        try {
            $category = $request->query->get('category', 'all');
            $posts = $this->getLocalPosts($category);
            
            $content = $this->render(__DIR__ . '/../Views/gallery.php', [
                'posts' => $posts,
                'currentCategory' => $category,
                'controller' => $this
            ]);
            return new Response($content);
        } catch (\Exception $e) {
            error_log('Gallery view error: ' . $e->getMessage());
            return new Response('Error loading gallery: ' . $e->getMessage(), 500);
        }
    }

    public function getLocalPosts(string $category = 'all'): array
    {
        try {
            if (!file_exists($this->postsFile)) {
                error_log('Posts file not found: ' . $this->postsFile);
                return [];
            }

            $postsContent = file_get_contents($this->postsFile);
            if ($postsContent === false) {
                error_log('Could not read posts file: ' . $this->postsFile);
                return [];
            }

            $posts = json_decode($postsContent, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                error_log('Invalid JSON in posts file: ' . json_last_error_msg());
                return [];
            }

            // Filter posts by category if specified
            if ($category !== 'all') {
                $posts = array_filter($posts, function($post) use ($category) {
                    return ($post['category'] ?? 'landscape') === $category;
                });
            }

            // Debug: wyświetl zawartość posts przed przetworzeniem
            error_log('Raw posts data: ' . print_r($posts, true));

            // Przetwarzanie każdego posta
            foreach ($posts as &$post) {
                // Dodaj domyślną kategorię jeśli nie istnieje
                if (!isset($post['category'])) {
                    $post['category'] = 'landscape';
                }
                
                // Upewnij się, że ścieżka do obrazu jest poprawna
                if (!isset($post['image']) || empty($post['image'])) {
                    error_log('Post without image: ' . print_r($post, true));
                    continue;
                }

                // Usuń początkowy ukośnik i zamień podwójne ukośniki na pojedyncze
                $post['image'] = ltrim(str_replace('//', '/', $post['image']), '/');
                
                // Sprawdź czy plik istnieje w public/uploads/posts
                $imagePath = dirname(dirname(dirname(__FILE__))) . '/public/' . $post['image'];
                error_log('Checking image path: ' . $imagePath);
                
                if (!file_exists($imagePath)) {
                    // Spróbuj znaleźć plik bezpośrednio w katalogu posts
                    $fileName = basename($post['image']);
                    $alternativePath = $this->postsDirectory . '/' . $fileName;
                    error_log('Checking alternative path: ' . $alternativePath);
                    
                    if (file_exists($alternativePath)) {
                        $post['image'] = 'uploads/posts/' . $fileName;
                        error_log('Found image at: ' . $post['image']);
                    } else {
                        error_log('Image not found in any location: ' . $fileName);
                        continue;
                    }
                }

                // Debug: wyświetl przetworzoną ścieżkę do obrazu
                error_log('Processed image path: ' . $post['image']);
            }

            // Usuń posty bez obrazów
            $posts = array_filter($posts, function($post) {
                return isset($post['image']) && !empty($post['image']);
            });

            // Sortowanie postów po dacie (od najnowszych)
            usort($posts, function($a, $b) {
                return strtotime($b['created_at'] ?? '0') - strtotime($a['created_at'] ?? '0');
            });

            // Debug: wyświetl końcową listę postów
            error_log('Final posts data: ' . print_r(array_values($posts), true));

            return array_values($posts); // Resetuj indeksy tablicy
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