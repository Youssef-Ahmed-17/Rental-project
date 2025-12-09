<?php
require_once __DIR__ . '/../core/Database.php';

class User {
    public $db;

    public function __construct() {
        // إنشاء اتصال بقاعدة البيانات داخل الـ Model
        $this->db = (new Database())->connect(); 
    }

    // التحقق من وجود البريد مسبقًا
    public function emailExists($email) {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->rowCount() > 0;
    }

    // إنشاء مستخدم جديد مع تشفير كلمة المرور
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

    // الحصول على جميع المستخدمين
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // عد المستخدمين حسب الحالة
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

    // تحديث حالة المستخدم (active, inactive, removed, etc.)
    public function updateStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE users SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }
}
