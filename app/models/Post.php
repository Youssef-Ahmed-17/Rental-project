<?php
require_once __DIR__ . '/../core/Database.php';

class Post {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM posts");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countByStatus($status) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as cnt FROM posts WHERE status = ?");
        $stmt->execute([$status]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['cnt'];
    }

    public function updateStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE posts SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }
}
