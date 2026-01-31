<?php

namespace App\Controllers\Admin;

use App\Core\Database;
use App\Core\Csrf;

class SettingsController extends AdminController {
    public function index() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM settings");
        $rows = $stmt->fetchAll();
        
        $settings = [];
        foreach ($rows as $row) {
            $settings[$row['key']] = $row['value'];
        }

        $this->view('admin/settings/index', ['settings' => $settings]);
    }

    public function update() {
        if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
            die('CSRF Failed');
        }

        $db = Database::connect();
        $fields = [
            'site_name', 'site_tagline', 'site_email', 
            'seo_title', 'seo_description', 'seo_robots',
            'social_github', 'social_linkedin', 'social_facebook', 'social_email',
            // Open Graph
            'og_image', 'og_type', 'og_site_name', 'og_locale',
            // Twitter Card
            'twitter_card', 'twitter_site', 'twitter_creator', 'twitter_image'
        ];

        foreach ($fields as $key) {
            if (isset($_POST[$key])) {
                $stmt = $db->prepare("INSERT INTO settings (key, value, updated_at) VALUES (?, ?, datetime('now')) ON CONFLICT(key) DO UPDATE SET value = ?, updated_at = datetime('now')");
                $stmt->execute([$key, $_POST[$key], $_POST[$key]]);
            }
        }

        $_SESSION['success'] = 'Beállítások frissítve.';
        $this->redirect('/admin/settings');
    }
}
