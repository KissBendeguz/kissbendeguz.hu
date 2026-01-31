<?php

namespace App\Controllers\Admin;

use App\Core\Database;

class MessagesController extends AdminController {
    public function index() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM messages ORDER BY created_at DESC");
        $messages = $stmt->fetchAll();

        $this->view('admin/messages/index', ['messages' => $messages]);
    }

    public function show() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect('/admin/messages');
        }

        $db = Database::connect();
        
        // Mark as read
        $updateForRead = $db->prepare("UPDATE messages SET status = 'read' WHERE id = ?");
        $updateForRead->execute([$id]);

        $stmt = $db->prepare("SELECT * FROM messages WHERE id = ?");
        $stmt->execute([$id]);
        $message = $stmt->fetch();

        if (!$message) {
             $this->redirect('/admin/messages');
        }

        $this->view('admin/messages/show', ['message' => $message]);
    }
}
