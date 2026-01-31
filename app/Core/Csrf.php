<?php

namespace App\Core;

class Csrf {
    public static function token(): string {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public static function field(): string {
        $token = self::token();
        return '<input type="hidden" name="csrf_token" value="' . $token . '">';
    }

    public static function verify(?string $token): bool {
        if (!$token || empty($_SESSION['csrf_token'])) {
            return false;
        }
        return hash_equals($_SESSION['csrf_token'], $token);
    }
}
