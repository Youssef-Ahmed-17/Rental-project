<?php
require_once __DIR__ . '/../core/Database.php';

class AdminUser {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   public function countByStatus($status = null) {
    if ($status !== null) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as cnt FROM users WHERE status = ?");
        $stmt->execute([$status]);
    } else {
        $stmt = $this->db->query("SELECT COUNT(*) as cnt FROM users");
    }

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['cnt'] ?? 0;
}


    public function updateStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE users SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }
}
