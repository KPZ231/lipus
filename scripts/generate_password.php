<?php

// This script generates a hashed password for use in your .env file

// Password set to 'admin'
$password = 'admin';

// Generate the hash using PASSWORD_DEFAULT algorithm
$hash = password_hash($password, PASSWORD_DEFAULT);

// Output the hash
echo "Your hashed password is:\n";
echo $hash . "\n";
echo "\nYou can use this in your .env file as:\n";
echo "ADMIN_PASSWORD=" . $hash . "\n"; 