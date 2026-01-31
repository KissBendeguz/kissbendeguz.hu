<?php

namespace App\Controllers\Admin;

use App\Core\Database;

class DashboardController extends AdminController {
    public function index() {
        $db = Database::connect();
        
        // Stats
        $newMessages = $db->query("SELECT COUNT(*) FROM messages WHERE status = 'new'")->fetchColumn();
        $totalMessages = $db->query("SELECT COUNT(*) FROM messages")->fetchColumn();
        $totalProjects = $db->query("SELECT COUNT(*) FROM projects")->fetchColumn();
        $totalStack = $db->query("SELECT COUNT(*) FROM stack_items")->fetchColumn(); // Count items, not categories
        $totalTestimonials = $db->query("SELECT COUNT(*) FROM testimonials")->fetchColumn();
        
        // Recent Messages
        $stmt = $db->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT 5");
        $recentMessages = $stmt->fetchAll();

        $this->view('admin/dashboard', [
            'newMessages' => $newMessages,
            'totalMessages' => $totalMessages,
            'totalProjects' => $totalProjects,
            'totalStack' => $totalStack,
            'totalTestimonials' => $totalTestimonials,
            'recentMessages' => $recentMessages
        ]);
    }
}
