<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Database;
use App\Core\Auth;
use App\Core\Csrf;

class LoginController extends Controller {
    public function showLoginForm() {
        if (Auth::check()) {
            $this->redirect('/admin');
        }
        $this->view('admin/login');
    }

    public function login() {
        if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
            die('CSRF Validation Failed');
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ? AND is_active = 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            Auth::login($user['id'], $user['role']);
            $this->redirect('/admin');
        } else {
            $_SESSION['error'] = 'Érvénytelen email vagy jelszó.';
            $_SESSION['old']['email'] = $email;
            $this->redirect('/admin/login');
        }
    }

    public function logout() {
        if (Csrf::verify($_POST['csrf_token'] ?? '')) {
            Auth::logout();
            $this->redirect('/admin/login');
        } else {
            die('CSRF Failed');
        }
    }
}
