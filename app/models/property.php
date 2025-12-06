<?php
require_once _DIR_.'/../core/Database.php';

class Property {
    public $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO property (landlord_id, title, description, city, monthly_rent, full_address, floor, bedrooms, bathrooms, area_sqft, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['landlord_id'],
            $data['title'],
            $data['description'],
            $data['city'],
            $data['monthly_rent'],
            $data['full_address'],
            $data['floor'],
            $data['bedrooms'],
            $data['bathrooms'],
            $data['area_sqft'],
            $data['status']
        ]);
    }

    public function getAvailableProperties() {
        return $this->db->query("SELECT * FROM property WHERE status='accepted'")->fetchAll();
    }

    public function getPropertiesByLandlord($landlord_id) {
        $stmt = $this->db->prepare("SELECT * FROM property WHERE landlord_id = ?");
        $stmt->execute([$landlord_id]);
        return $stmt->fetchAll();
    }
}