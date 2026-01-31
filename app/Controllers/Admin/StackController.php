<?php

namespace App\Controllers\Admin;

use App\Core\Database;
use App\Core\Csrf;

class StackController extends AdminController {
    
    public function index() {
        $db = Database::connect();
        $categories = $db->query("SELECT * FROM stack_categories ORDER BY sort_order ASC")->fetchAll();
        $items = $db->query("SELECT * FROM stack_items ORDER BY sort_order ASC")->fetchAll();
        
        // Group items by category
        $grouped = [];
        foreach ($categories as $cat) {
            $grouped[$cat['id']] = $cat;
            $grouped[$cat['id']]['items'] = [];
        }
        foreach ($items as $item) {
            if (isset($grouped[$item['category_id']])) {
                $grouped[$item['category_id']]['items'][] = $item;
            }
        }

        $this->view('admin/stack/index', ['stack' => $grouped]);
    }

    public function storeCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Csrf::verify($_POST['csrf_token'] ?? '')) die('CSRF Error');
            
            $db = Database::connect();
            $stmt = $db->prepare("INSERT INTO stack_categories (name, sort_order) VALUES (?, ?)");
            $stmt->execute([$_POST['name'], $_POST['sort_order'] ?? 0]);
            
            $_SESSION['success'] = 'Kategória hozzáadva.';
            $this->redirect('/admin/stack');
        }
    }

    public function deleteCategory() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $db = Database::connect();
            $stmt = $db->prepare("DELETE FROM stack_categories WHERE id = ?");
            $stmt->execute([$id]);
            $_SESSION['success'] = 'Kategória törölve.';
        }
        $this->redirect('/admin/stack');
    }

    public function storeItem() {
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Csrf::verify($_POST['csrf_token'] ?? '')) die('CSRF Error');
            
            $db = Database::connect();
            $stmt = $db->prepare("INSERT INTO stack_items (category_id, name, sort_order) VALUES (?, ?, ?)");
            $stmt->execute([$_POST['category_id'], $_POST['name'], $_POST['sort_order'] ?? 0]);
            
            $_SESSION['success'] = 'Elem hozzáadva.';
            $this->redirect('/admin/stack');
        }
    }

    public function deleteItem() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $db = Database::connect();
            $stmt = $db->prepare("DELETE FROM stack_items WHERE id = ?");
            $stmt->execute([$id]);
            $_SESSION['success'] = 'Elem törölve.';
        }
        $this->redirect('/admin/stack');
    }

    public function reorderItems() {
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data || !isset($data['order'])) return;

        // CSRF Check (Simplified for AJAX)
        // if (!Csrf::verify($data['csrf_token'] ?? '')) { echo json_encode(['success'=>false, 'error'=>'csrf']); exit; }

        $db = Database::connect();
        $db->beginTransaction();
        try {
            $stmt = $db->prepare("UPDATE stack_items SET sort_order = ?, category_id = ? WHERE id = ?");
            foreach ($data['order'] as $item) {
                $stmt->execute([$item['position'], $item['category_id'], $item['id']]);
            }
            $db->commit();
            echo json_encode(['success' => true]);
        } catch (\Exception $e) {
            $db->rollBack();
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        exit;
    }

    public function reorderCategories() {
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data || !isset($data['order'])) return;

        $db = Database::connect();
        $db->beginTransaction();
        try {
            $stmt = $db->prepare("UPDATE stack_categories SET sort_order = ? WHERE id = ?");
            foreach ($data['order'] as $cat) {
                $stmt->execute([$cat['position'], $cat['id']]);
            }
            $db->commit();
            echo json_encode(['success' => true]);
        } catch (\Exception $e) {
            $db->rollBack();
            echo json_encode(['success' => false]);
        }
        exit;
    }
}
