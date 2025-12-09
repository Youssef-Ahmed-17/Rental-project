<?php
require_once __DIR__ . '/../core/Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function emailExists($email) {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->rowCount() > 0;
    }

    public function create($data) {
        if ($this->emailExists($data['email'])) {
            return false;
        }

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

        if(!$success){
            print_r($stmt->errorInfo());
        }

        return $success;
    }
}
