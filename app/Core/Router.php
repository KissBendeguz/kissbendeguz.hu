<?php

namespace App\Core;

class Router {
    private array $routes = [];

    public function get(string $path, callable|array $handler) {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, callable|array $handler) {
        $this->routes['POST'][$path] = $handler;
    }

    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (array_key_exists($path, $this->routes[$method] ?? [])) {
            $handler = $this->routes[$method][$path];
            if (is_array($handler)) {
                $controller = new $handler[0]();
                call_user_func([$controller, $handler[1]]);
            } else {
                call_user_func($handler);
            }
        } else {
            http_response_code(404);
            require __DIR__ . '/../Views/public/404.php';
        }
    }
}
