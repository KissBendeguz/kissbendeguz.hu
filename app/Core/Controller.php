<?php

namespace App\Core;

class Controller {
    protected function view(string $viewPath, array $data = []) {
        extract($data);
        $fullPath = __DIR__ . "/../Views/$viewPath.php";
        if (file_exists($fullPath)) {
            require $fullPath;
        } else {
            die("View not found: $viewPath");
        }
    }

    protected function json(array $data, int $statusCode = 200) {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }

    protected function redirect(string $url) {
        header("Location: $url");
        exit;
    }
}
