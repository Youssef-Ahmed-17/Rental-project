<?php
require_once __DIR__ . '/../core/Database.php';

class Post {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    // Get all posts
    public function getAll() {
        try {
            $stmt = $this->db->query("SELECT * FROM posts ORDER BY created_at DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Get all posts failed: " . $e->getMessage());
            return [];
        }
    }

    // Count posts by status
    public function countByStatus($status) {
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) as cnt FROM posts WHERE status = ?");
            $stmt->execute([$status]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['cnt'] ?? 0;
        } catch (PDOException $e) {
            error_log("Count posts failed: " . $e->getMessage());
            return 0;
        }
    }

    // Update post status
    public function updateStatus($id, $status) {
        try {
            $stmt = $this->db->prepare("UPDATE posts SET status = ? WHERE id = ?");
            return $stmt->execute([$status, $id]);
        } catch (PDOException $e) {
            error_log("Update post status failed: " . $e->getMessage());
            return false;
        }
    }

    // Get post by ID
    public function findById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM posts WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Find post failed: " . $e->getMessage());
            return null;
        }
    }

    // Create new post
    public function create($data) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO posts 
                (user_id, title, description, status, created_at) 
                VALUES (?, ?, ?, 'Pending', NOW())
            ");

            return $stmt->execute([
                $data['user_id'],
                $data['title'],
                $data['description']
            ]);
        } catch (PDOException $e) {
            error_log("Create post failed: " . $e->getMessage());
            return false;
        }
    }
}