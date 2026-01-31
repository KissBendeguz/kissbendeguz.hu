<?php

namespace App\Controllers\Admin;

use App\Core\Database;
use App\Core\Csrf;

class TestimonialController extends AdminController {
    
    public function index() {
        $db = Database::connect();
        $testimonials = $db->query("SELECT * FROM testimonials ORDER BY sort_order ASC")->fetchAll();
        $this->view('admin/testimonials/index', ['testimonials' => $testimonials]);
    }

    public function create() {
        $this->view('admin/testimonials/create');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Csrf::verify($_POST['csrf_token'] ?? '')) die('CSRF Error');

            $db = Database::connect();
            $stmt = $db->prepare("INSERT INTO testimonials (text, author, role, sort_order) VALUES (?, ?, ?, ?)");
            $stmt->execute([
                $_POST['text'],
                $_POST['author'],
                $_POST['role'],
                $_POST['sort_order'] ?? 0
            ]);

            $_SESSION['success'] = 'Vélemény hozzáadva.';
            $this->redirect('/admin/testimonials');
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) $this->redirect('/admin/testimonials');

        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM testimonials WHERE id = ?");
        $stmt->execute([$id]);
        $item = $stmt->fetch();

        if (!$item) $this->redirect('/admin/testimonials');

        $this->view('admin/testimonials/edit', ['item' => $item]);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Csrf::verify($_POST['csrf_token'] ?? '')) die('CSRF Error');

            $db = Database::connect();
            $stmt = $db->prepare("UPDATE testimonials SET text=?, author=?, role=?, sort_order=? WHERE id=?");
            $stmt->execute([
                $_POST['text'],
                $_POST['author'],
                $_POST['role'],
                $_POST['sort_order'],
                $_POST['id']
            ]);

            $_SESSION['success'] = 'Vélemény frissítve.';
            $this->redirect('/admin/testimonials');
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $db = Database::connect();
            $stmt = $db->prepare("DELETE FROM testimonials WHERE id = ?");
            $stmt->execute([$id]);
            $_SESSION['success'] = 'Vélemény törölve.';
        }
        $this->redirect('/admin/testimonials');
    }

    public function reorder() {
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data || !isset($data['order'])) return;

        $db = Database::connect();
        $db->beginTransaction();
        try {
            $stmt = $db->prepare("UPDATE testimonials SET sort_order = ? WHERE id = ?");
            foreach ($data['order'] as $item) {
                $stmt->execute([$item['position'], $item['id']]);
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
