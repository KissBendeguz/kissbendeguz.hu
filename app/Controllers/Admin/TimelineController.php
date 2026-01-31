<?php

namespace App\Controllers\Admin;

use App\Core\Database;
use App\Core\Csrf;

class TimelineController extends AdminController {
    
    public function index() {
        $db = Database::connect();
        $timeline = $db->query("SELECT * FROM timeline ORDER BY sort_order ASC")->fetchAll();
        $this->view('admin/timeline/index', ['timeline' => $timeline]);
    }

    public function create() {
        $this->view('admin/timeline/create');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Csrf::verify($_POST['csrf_token'] ?? '')) die('CSRF Error');

            $db = Database::connect();
            $stmt = $db->prepare("INSERT INTO timeline (year, title, place, description, sort_order) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([
                $_POST['year'],
                $_POST['title'],
                $_POST['place'],
                $_POST['description'],
                $_POST['sort_order'] ?? 0
            ]);

            $_SESSION['success'] = 'Bejegyzés hozzáadva.';
            $this->redirect('/admin/timeline');
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) $this->redirect('/admin/timeline');

        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM timeline WHERE id = ?");
        $stmt->execute([$id]);
        $item = $stmt->fetch();

        if (!$item) $this->redirect('/admin/timeline');

        $this->view('admin/timeline/edit', ['item' => $item]);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Csrf::verify($_POST['csrf_token'] ?? '')) die('CSRF Error');

            $db = Database::connect();
            $stmt = $db->prepare("UPDATE timeline SET year=?, title=?, place=?, description=?, sort_order=? WHERE id=?");
            $stmt->execute([
                $_POST['year'],
                $_POST['title'],
                $_POST['place'],
                $_POST['description'],
                $_POST['sort_order'],
                $_POST['id']
            ]);

            $_SESSION['success'] = 'Bejegyzés frissítve.';
            $this->redirect('/admin/timeline');
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $db = Database::connect();
            $stmt = $db->prepare("DELETE FROM timeline WHERE id = ?");
            $stmt->execute([$id]);
            $_SESSION['success'] = 'Bejegyzés törölve.';
        }
        $this->redirect('/admin/timeline');
    }

    public function reorder() {
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data || !isset($data['order'])) return;

        $db = Database::connect();
        $db->beginTransaction();
        try {
            $stmt = $db->prepare("UPDATE timeline SET sort_order = ? WHERE id = ?");
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
