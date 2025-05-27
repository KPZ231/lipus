<?php

// This script creates a .env file with admin credentials

// Admin credentials
$username = 'admin';
$password = 'admin';
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Generate JWT secret
$jwtSecret = bin2hex(random_bytes(32));

// Create .env content - using quotes around values to prevent parse_ini_file issues
$envContent = <<<EOT
# Admin login credentials
ADMIN_USERNAME="$username"

# Admin password (hashed using password_hash)
# This is the hash for password: '$password'
ADMIN_PASSWORD="$passwordHash"

# JWT Secret - used for generating secure tokens
JWT_SECRET="$jwtSecret"

EOT;

// Write to .env file
$envFile = dirname(__DIR__) . '/.env';
file_put_contents($envFile, $envContent);

echo "✅ .env file created successfully with:\n";
echo "Username: $username\n";
echo "Password: $password\n";
echo "JWT Secret: Generated\n";
echo "\nFile location: $envFile\n"; 