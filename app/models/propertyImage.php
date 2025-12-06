<?php
require_once _DIR_.'/../core/Database.php';

class PropertyImage {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function create($property_id, $path) {
        $stmt = $this->db->prepare("INSERT INTO property_images (property_id, image_path) VALUES (?, ?)");
        return $stmt->execute([$property_id, $path]);
    }

    public function getImagesByProperty($property_id) {
        $stmt = $this->db->prepare("SELECT * FROM property_images WHERE property_id = ?");
        $stmt->execute([$property_id]);
        return $stmt->fetchAll();
    }
}