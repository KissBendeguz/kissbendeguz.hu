<?php

namespace App\Controllers\Admin;

use App\Core\Database;
use App\Core\Csrf;

class ProjectsController extends AdminController {
    
    public function index() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM projects ORDER BY sort_order ASC, created_at DESC");
        $projects = $stmt->fetchAll();
        $this->view('admin/projects/index', ['projects' => $projects]);
    }

    public function create() {
        $this->view('admin/projects/create');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Csrf::verify($_POST['csrf_token'] ?? '')) die('CSRF Error');

            $db = Database::connect();
            $stmt = $db->prepare("INSERT INTO projects (name, slug, description, image, url, status, tech_stack, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            
            // Handle tech stack as JSON
            $tech = array_map('trim', explode(',', $_POST['tech_stack']));
            
            $stmt->execute([
                $_POST['name'],
                $_POST['slug'],
                $_POST['description'],
                $_POST['image'],
                $_POST['url'],
                $_POST['status'],
                json_encode($tech),
                $_POST['sort_order'] ?? 0
            ]);

            $_SESSION['success'] = 'Projekt létrehozva.';
            $this->redirect('/admin/projects');
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) $this->redirect('/admin/projects');

        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM projects WHERE id = ?");
        $stmt->execute([$id]);
        $project = $stmt->fetch();

        if (!$project) $this->redirect('/admin/projects');

        $this->view('admin/projects/edit', ['project' => $project]);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Csrf::verify($_POST['csrf_token'] ?? '')) die('CSRF Error');

            $db = Database::connect();
            $stmt = $db->prepare("UPDATE projects SET name=?, slug=?, description=?, image=?, url=?, status=?, tech_stack=?, sort_order=?, updated_at=CURRENT_TIMESTAMP WHERE id=?");
            
            $tech = array_map('trim', explode(',', $_POST['tech_stack']));
            
            $stmt->execute([
                $_POST['name'],
                $_POST['slug'],
                $_POST['description'],
                $_POST['image'],
                $_POST['url'],
                $_POST['status'],
                json_encode($tech),
                $_POST['sort_order'],
                $_POST['id']
            ]);

            $_SESSION['success'] = 'Projekt frissítve.';
            $this->redirect('/admin/projects');
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $db = Database::connect();
            $stmt = $db->prepare("DELETE FROM projects WHERE id = ?");
            $stmt->execute([$id]);
            $_SESSION['success'] = 'Projekt törölve.';
        }
        $this->redirect('/admin/projects');
    }

    public function reorder() {
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data || !isset($data['order'])) return;

        $db = Database::connect();
        $db->beginTransaction();
        try {
            $stmt = $db->prepare("UPDATE projects SET sort_order = ? WHERE id = ?");
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
