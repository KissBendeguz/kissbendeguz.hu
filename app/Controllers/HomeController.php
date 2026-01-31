<?php

namespace App\Controllers;

use App\Core\Database;
use App\Core\Controller;

class HomeController extends Controller {
    public function index() {
        $db = Database::connect();
        
        // Fetch Settings
        $stmt = $db->query("SELECT * FROM settings");
        $settingsRaw = $stmt->fetchAll();
        $settings = [];
        foreach ($settingsRaw as $s) {
            $settings[$s['key']] = $s['value'];
        }

        // Fetch Projects
        $projects = $db->query("SELECT * FROM projects WHERE status != 'Archív' ORDER BY sort_order ASC, created_at DESC")->fetchAll();
        
        // Fetch Stack (Grouped)
        $categories = $db->query("SELECT * FROM stack_categories ORDER BY sort_order ASC")->fetchAll();
        $items = $db->query("SELECT * FROM stack_items ORDER BY sort_order ASC")->fetchAll();
        $stack = [];
        foreach ($categories as $cat) {
            $stack[$cat['name']] = [];
        }
        $catMap = array_column($categories, 'name', 'id');
        foreach ($items as $item) {
            if (isset($catMap[$item['category_id']])) {
                $stack[$catMap[$item['category_id']]][] = $item['name'];
            }
        }

        // Fetch Timeline
        $timeline = $db->query("SELECT * FROM timeline ORDER BY sort_order ASC")->fetchAll();

        // Fetch Testimonials
        $testimonials = $db->query("SELECT * FROM testimonials ORDER BY sort_order ASC")->fetchAll();

        // Pass data to view
        $this->view('public/home', [
            'settings' => $settings,
            'projects' => $projects,
            'stack' => $stack,
            'timeline' => $timeline,
            'testimonials' => $testimonials
        ]);
    }
}
