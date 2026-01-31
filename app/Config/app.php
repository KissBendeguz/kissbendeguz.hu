<?php

$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$isDev = in_array($host, ['localhost', '127.0.0.1']) || strpos($host, 'localhost:') === 0;

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$baseUrl = $protocol . '://' . $host;

return [
    'app_name' => 'Kiss Bendegúz Portfolio',
    'base_url' => $baseUrl,
    'db_path' => __DIR__ . '/../Database/database.sqlite',
    'environment' => $isDev ? 'development' : 'production',
];
