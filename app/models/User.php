<?php
require_once _DIR_.'/../core/Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password, phone, city, national_id, role_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['name'],
            $data['email'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            $data['phone'],
            $data['city'],
            $data['national_id'],
            $data['role_id']
        ]);
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function getRoles() {
        return $this->db->query("SELECT * FROM roles")->fetchAll();
    }
}