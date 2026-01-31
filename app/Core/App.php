<?php

namespace App\Core;

require_once __DIR__ . '/Router.php';
require_once __DIR__ . '/Database.php';

class App {
    private Router $router;

    public function __construct() {
        $this->router = new Router();
    }

    public function run() {
        $router = $this->router;
        require_once __DIR__ . '/../Config/routes.php';
        $this->router->dispatch();
    }
}
