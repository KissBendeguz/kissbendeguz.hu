<?php

use App\Core\Csrf;

function e($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

function csrf_field() {
    return Csrf::field();
}

function csrf_token() {
    return Csrf::token();
}

function old($key, $default = '') {
    return $_SESSION['old'][$key] ?? $default;
}

function url($path = '') {
    $config = require __DIR__ . '/../Config/app.php';
    return rtrim($config['base_url'], '/') . '/' . ltrim($path, '/');
}

function asset($path) {
    return url($path);
}
