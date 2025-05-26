<?php

$password = 'admin'; // twoje hasło
$hash = password_hash($password, PASSWORD_DEFAULT);
echo "Hash dla hasła '$password': " . $hash; 