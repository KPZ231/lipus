<?php
namespace Kpzsproductions\Lipus\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    private $pricesFile;

    public function __construct()
    {
        $this->pricesFile = dirname(dirname(__DIR__)) . '/public/uploads/prices.json';
    }

    public function index(Request $request): Response
    {
        // Load prices from the prices.json file
        $prices = $this->loadPrices();
        
        // Render the view with the prices data
        $content = $this->render(__DIR__ . '/../Views/home.php', [
            'prices' => $prices
        ]);
        return new Response($content);
    }

    private function loadPrices(): array
    {
        // Default prices if the file doesn't exist
        $defaultPrices = [
            'price1Wedka' => 25,
            'price2Wedki' => 40,
            'priceGrill' => 10
        ];

        if (!file_exists($this->pricesFile)) {
            return $defaultPrices;
        }

        $pricesData = json_decode(file_get_contents($this->pricesFile), true);
        if ($pricesData === null) {
            return $defaultPrices;
        }

        return $pricesData;
    }

    private function render(string $path, array $vars = []): string
    {
        extract($vars);
        ob_start();
        include $path;
        return ob_get_clean();
    }
}
