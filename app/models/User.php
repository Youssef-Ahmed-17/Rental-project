<?php
require_once __DIR__ . '/../core/Database.php';

class User {
    public $db;

    public function __construct() {
        $this->db = (new Database())->connect(); 
    }

    // Check if email already exists
    public function emailExists($email) {
        try {
            $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Email check failed: " . $e->getMessage());
            return false;
        }
    }

    // Create new user with password hashing
    public function create($data) {
        if ($this->emailExists($data['email'])) {
            return false;
        }

        try {
            $stmt = $this->db->prepare("
                INSERT INTO users 
                (role, name, email, password, national_id, city, phone, created_at, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), 'active')
            ");

            $success = $stmt->execute([
                $data['role'],
                $data['name'],
                $data['email'],
                password_hash($data['password'], PASSWORD_DEFAULT),
                $data['national_id'],
                $data['city'],
                $data['phone']
            ]);

            return $success;
        } catch (PDOException $e) {
            error_log("User creation failed: " . $e->getMessage());
            return false;
        }
    }

    // Get all users
    public function getAll() {
        try {
            $stmt = $this->db->query("SELECT * FROM users ORDER BY created_at DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Get all users failed: " . $e->getMessage());
            return [];
        }
    }

    // Count users by status (or all if null)
    public function countByStatus($status = null) {
        try {
            if ($status !== null) {
                $stmt = $this->db->prepare("SELECT COUNT(*) as cnt FROM users WHERE status = ?");
                $stmt->execute([$status]);
            } else {
                $stmt = $this->db->query("SELECT COUNT(*) as cnt FROM users"); 
            }

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['cnt'] ?? 0;
        } catch (PDOException $e) {
            error_log("Count users failed: " . $e->getMessage());
            return 0;
        }
    }

    // Update user status
    public function updateStatus($id, $status) {
        try {
            $stmt = $this->db->prepare("UPDATE users SET status = ? WHERE id = ?");
            return $stmt->execute([$status, $id]);
        } catch (PDOException $e) {
            error_log("Update user status failed: " . $e->getMessage());
            return false;
        }
    }

    // Get user by ID
    public function findById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Find user failed: " . $e->getMessage());
            return null;
        }
    }
}