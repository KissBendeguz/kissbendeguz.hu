<?php

namespace App\Controllers\Admin;

use App\Core\Database;
use App\Core\Auth;
use App\Core\Csrf;

class MediaController extends AdminController {
    
    public function index() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM media ORDER BY created_at DESC");
        $media = $stmt->fetchAll();

        // Check if it's an API request (for modal)
        if (isset($_GET['api'])) {
            header('Content-Type: application/json');
            echo json_encode($media);
            exit;
        }

        $this->view('admin/media/index', ['media' => $media]);
    }

    public function upload() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
                // If API upload, return JSON error
                if (isset($_POST['api'])) {
                    http_response_code(403);
                    echo json_encode(['error' => 'CSRF Token Mismatch']);
                    exit;
                }
                die('CSRF Validation Failed');
            }

            if (!empty($_FILES['file']['name'])) {
                $file = $_FILES['file'];
                $uploadDir = __DIR__ . '/../../../public/assets/uploads/';
                
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $filename = uniqid() . '.' . $ext;
                $targetPath = $uploadDir . $filename;
                
                // Allow only images
                $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg'];
                if (!in_array(strtolower($ext), $allowed)) {
                     if (isset($_POST['api'])) {
                        http_response_code(400);
                        echo json_encode(['error' => 'Invalid file type']);
                        exit;
                    }
                    $_SESSION['error'] = 'Csak képek tölthetők fel!';
                    $this->redirect('/admin/media');
                }

                if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                    $db = Database::connect();
                    $stmt = $db->prepare("INSERT INTO media (filename, filepath, mime_type, size) VALUES (?, ?, ?, ?)");
                    $webPath = 'assets/uploads/' . $filename;
                    $stmt->execute([$file['name'], $webPath, $file['type'], $file['size']]);
                    
                    if (isset($_POST['api'])) {
                        echo json_encode([
                            'success' => true, 
                            'file' => [
                                'id' => $db->lastInsertId(),
                                'filepath' => $webPath,
                                'filename' => $file['name']
                            ]
                        ]);
                        exit;
                    }

                    $_SESSION['success'] = 'Fájl sikeresen feltöltve!';
                } else {
                     if (isset($_POST['api'])) {
                        http_response_code(500);
                        echo json_encode(['error' => 'Upload failed']);
                        exit;
                    }
                    $_SESSION['error'] = 'Hiba a feltöltés során.';
                }
            }
        }
        $this->redirect('/admin/media');
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect('/admin/media');
        }

        $db = Database::connect();
        $stmt = $db->prepare("SELECT filepath FROM media WHERE id = ?");
        $stmt->execute([$id]);
        $file = $stmt->fetch();

        if ($file) {
            $fullPath = __DIR__ . '/../../../public/' . $file['filepath'];
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
            $stmt = $db->prepare("DELETE FROM media WHERE id = ?");
            $stmt->execute([$id]);
            $_SESSION['success'] = 'Fájl törölve.';
        }

        $this->redirect('/admin/media');
    }
}
