<?php
require_once __DIR__ . '/../core/Database.php';

class Request {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    // Get all requests with user info
    public function getAll() {
        try {
            $stmt = $this->db->query("
                SELECT r.*, u.name, u.email, u.city, u.phone 
                FROM requests r 
                JOIN users u ON r.user_id = u.id 
                ORDER BY r.created_at DESC
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Get all requests failed: " . $e->getMessage());
            return [];
        }
    }

    // Count requests by status
    public function countByStatus($status) {
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) as cnt FROM requests WHERE status = ?");
            $stmt->execute([$status]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['cnt'] ?? 0;
        } catch (PDOException $e) {
            error_log("Count requests failed: " . $e->getMessage());
            return 0;
        }
    }

    // Update request status
    public function updateStatus($id, $status) {
        try {
            $stmt = $this->db->prepare("UPDATE requests SET status = ? WHERE id = ?");
            return $stmt->execute([$status, $id]);
        } catch (PDOException $e) {
            error_log("Update request status failed: " . $e->getMessage());
            return false;
        }
    }

    // Get request by ID
    public function findById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM requests WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Find request failed: " . $e->getMessage());
            return null;
        }
    }

    // Create new request
    public function create($data) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO requests 
                (user_id, type, message, status, created_at) 
                VALUES (?, ?, ?, 'Pending', NOW())
            ");

            return $stmt->execute([
                $data['user_id'],
                $data['type'] ?? 'landlord',
                $data['message'] ?? ''
            ]);
        } catch (PDOException $e) {
            error_log("Create request failed: " . $e->getMessage());
            return false;
        }
    }
}