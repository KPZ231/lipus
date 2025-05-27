<?php
namespace Kpzsproductions\Lipus\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SitemapController
{
    public function index(Request $request): Response
    {
        // Definicja stron w serwisie
        $urls = [
            [
                'loc' => 'https://twojadomena.pl/',
                'lastmod' => date('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '1.0'
            ],
            [
                'loc' => 'https://twojadomena.pl/gallery',
                'lastmod' => date('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.8'
            ],
            [
                'loc' => 'https://twojadomena.pl/rules',
                'lastmod' => date('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.7'
            ],
            [
                'loc' => 'https://twojadomena.pl/privacy-policy',
                'lastmod' => date('Y-m-d'),
                'changefreq' => 'yearly',
                'priority' => '0.5'
            ]
        ];

        // Generuj XML
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');

        foreach ($urls as $url) {
            $urlElement = $xml->addChild('url');
            $urlElement->addChild('loc', $url['loc']);
            $urlElement->addChild('lastmod', $url['lastmod']);
            $urlElement->addChild('changefreq', $url['changefreq']);
            $urlElement->addChild('priority', $url['priority']);
        }

        $response = new Response($xml->asXML());
        $response->headers->set('Content-Type', 'application/xml');
        
        return $response;
    }
} 