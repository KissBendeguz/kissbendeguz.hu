<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Core\Csrf;

class ContactController extends Controller {
    public function send() {
        if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
            $this->json(['status' => 'error', 'message' => 'CSRF Validation Failed'], 403);
            return;
        }

        // Rate Limit check (Simple Session based)
        $lastSubmit = $_SESSION['last_contact_submit'] ?? 0;
        if (time() - $lastSubmit < 60) {
            $this->json(['status' => 'error', 'message' => 'Kérlek várj egy percet az újabb üzenet előtt.'], 429);
            return;
        }

        // Honeypot
        if (!empty($_POST['honey_pot'])) {
            $this->json(['status' => 'success', 'message' => 'Üzenet elküldve!']); // Fake success
            return;
        }

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $message = trim($_POST['message'] ?? '');
        $subject = trim($_POST['subject'] ?? '');

        if (empty($name) || empty($email) || empty($message)) {
            $this->json(['status' => 'error', 'message' => 'Minden kötelező mezőt tölts ki!'], 400);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->json(['status' => 'error', 'message' => 'Érvénytelen email cím!'], 400);
            return;
        }

        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO messages (name, email, subject, message, ip_address, user_agent, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, datetime('now'), datetime('now'))");
        
        $success = $stmt->execute([
            $name,
            $email,
            $subject,
            $message,
            $_SERVER['REMOTE_ADDR'] ?? null,
            $_SERVER['HTTP_USER_AGENT'] ?? null
        ]);

        if ($success) {
            $_SESSION['last_contact_submit'] = time();
            $this->json(['status' => 'success', 'message' => 'Köszönöm az üzeneted! Hamarosan válaszolok.']);
        } else {
            $this->json(['status' => 'error', 'message' => 'Szerver hiba történt.'], 500);
        }
    }
}
