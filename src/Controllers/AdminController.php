<?php
namespace Kpzsproductions\Lipus\Controllers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;

class AdminController
{
    private $adminUsername;
    private $adminPassword;
    private $jwtSecret;
    private $session;
    private $postsDirectory;

    public function __construct()
    {
        $this->loadEnvironmentVariables();
        $this->session = new Session();
        $this->session->start();
        $this->postsDirectory = dirname(dirname(__DIR__)) . '/public/uploads/posts';
        
        if (!file_exists($this->postsDirectory)) {
            mkdir($this->postsDirectory, 0777, true);
        }
    }

    private function loadEnvironmentVariables()
    {
        $envFile = dirname(dirname(__DIR__)) . '/.env';
        if (!file_exists($envFile)) {
            throw new \RuntimeException('Configuration file (.env) not found');
        }

        $envVars = parse_ini_file($envFile);
        if ($envVars === false) {
            throw new \RuntimeException('Invalid configuration file format');
        }

        $this->adminUsername = $envVars['ADMIN_USERNAME'] ?? '';
        $this->adminPassword = $envVars['ADMIN_PASSWORD'] ?? '';
        $this->jwtSecret = $envVars['JWT_SECRET'] ?? '';

        if (empty($this->adminUsername) || empty($this->adminPassword) || empty($this->jwtSecret)) {
            throw new \RuntimeException('Admin credentials or JWT secret not configured');
        }
    }

    public function loginPage(Request $request): Response
    {
        if ($this->isAuthenticated()) {
            return new Response('', 302, ['Location' => '/admin/panel']);
        }
        return new Response($this->render(__DIR__ . '/../Views/admin/login.php'));
    }

    public function login(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';

        if ($username === $this->adminUsername && password_verify($password, $this->adminPassword)) {
            $token = $this->generateJWT();
            $this->session->set('admin_logged_in', true);
            return new JsonResponse(['token' => $token]);
        }

        return new JsonResponse(['error' => 'Invalid credentials'], 401);
    }

    public function panel(Request $request): Response
    {
        if (!$this->isAuthenticated()) {
            return new Response('', 302, ['Location' => '/admin/login']);
        }
        return new Response($this->render(__DIR__ . '/../Views/admin/panel.php'));
    }

    public function addPost(Request $request): JsonResponse
    {
        if (!$this->isAuthenticated()) {
            return new JsonResponse(['error' => 'Unauthorized'], 401);
        }

        $title = $request->request->get('title');
        $description = $request->request->get('description');
        $image = $request->files->get('image');

        if (!$title || !$description || !$image) {
            return new JsonResponse(['error' => 'Missing required fields'], 400);
        }

        try {
            $fileName = uniqid() . '_' . $image->getClientOriginalName();
            $image->move($this->postsDirectory, $fileName);

            $post = [
                'id' => uniqid(),
                'title' => $title,
                'description' => $description,
                'image' => '/uploads/posts/' . $fileName,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->savePost($post);

            return new JsonResponse(['success' => true, 'post' => $post]);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    public function getPosts(Request $request): JsonResponse
    {
        if (!$this->isAuthenticated()) {
            return new JsonResponse(['error' => 'Unauthorized'], 401);
        }

        $posts = $this->loadPosts();
        return new JsonResponse(['posts' => $posts]);
    }

    private function generateJWT(): string
    {
        $payload = [
            'user' => $this->adminUsername,
            'exp' => time() + (60 * 60), // 1 hour expiration
            'iat' => time()
        ];

        return JWT::encode($payload, $this->jwtSecret, 'HS256');
    }

    private function isAuthenticated(): bool
    {
        return $this->session->get('admin_logged_in', false);
    }

    private function savePost(array $post): void
    {
        $postsFile = $this->postsDirectory . '/posts.json';
        $posts = $this->loadPosts();
        array_unshift($posts, $post);
        file_put_contents($postsFile, json_encode($posts, JSON_PRETTY_PRINT));
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

    public function logout(Request $request): Response
    {
        $this->session->clear();
        return new Response('', 302, ['Location' => '/admin/login']);
    }
} 