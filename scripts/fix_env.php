<?php

// Simple script to create a correctly formatted .env file

// Generate password hash for 'admin'
$password = 'admin';
$hash = password_hash($password, PASSWORD_DEFAULT);

// Generate JWT secret
$jwt = bin2hex(random_bytes(16));

// Write directly to file
$content = 'ADMIN_USERNAME="admin"' . PHP_EOL;
$content .= 'ADMIN_PASSWORD="' . $hash . '"' . PHP_EOL;
$content .= 'JWT_SECRET="' . $jwt . '"' . PHP_EOL;

file_put_contents(dirname(__DIR__) . '/.env', $content);

echo "New .env file created successfully!\n";
echo "- Username: admin\n";
echo "- Password: admin\n";
echo "- JWT Secret: {$jwt}\n"; 