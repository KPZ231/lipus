<?php

namespace Kpzsproductions\Lipus\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockedController
{
    public function show(Request $request): Response
    {
        $html = file_get_contents(__DIR__ . '/../Views/blocked.html');
        return new Response($html, 403, ['Content-Type' => 'text/html']);
    }
}
