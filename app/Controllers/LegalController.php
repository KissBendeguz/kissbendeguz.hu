<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;

class LegalController extends Controller {
    
    private function getSettings() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM settings");
        $rows = $stmt->fetchAll();
        $settings = [];
        foreach ($rows as $row) {
            $settings[$row['key']] = $row['value'];
        }
        return $settings;
    }

    public function privacy() {
        $this->view('public/legal/privacy', ['settings' => $this->getSettings()]);
    }

    public function cookies() {
        $this->view('public/legal/cookies', ['settings' => $this->getSettings()]);
    }
}
