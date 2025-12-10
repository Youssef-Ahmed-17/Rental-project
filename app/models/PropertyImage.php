<?php
require_once __DIR__ . '/../core/Database.php';

class PropertyImage {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    // Get all images for a property
    public function findByProperty($propertyId) {
        try {
            $stmt = $this->db->prepare("
                SELECT * FROM property_images 
                WHERE property_id = ? 
                ORDER BY image_id ASC
            ");
            $stmt->execute([$propertyId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Get property images failed: " . $e->getMessage());
            return [];
        }
    }

    // Add image to property
    public function create($data) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO property_images (property_id, image_url) 
                VALUES (?, ?)
            ");
            return $stmt->execute([
                $data['property_id'],
                $data['image_url']
            ]);
        } catch (PDOException $e) {
            error_log("Create property image failed: " . $e->getMessage());
            return false;
        }
    }

    // Delete image
    public function delete($imageId) {
        try {
            $stmt = $this->db->prepare("
                DELETE FROM property_images WHERE image_id = ?
            ");
            return $stmt->execute([$imageId]);
        } catch (PDOException $e) {
            error_log("Delete property image failed: " . $e->getMessage());
            return false;
        }
    }

    // Delete all images for a property
    public function deleteByProperty($propertyId) {
        try {
            $stmt = $this->db->prepare("
                DELETE FROM property_images WHERE property_id = ?
            ");
            return $stmt->execute([$propertyId]);
        } catch (PDOException $e) {
            error_log("Delete property images failed: " . $e->getMessage());
            return false;
        }
    }

    // Get main image for property
    public function getMainImage($propertyId) {
        try {
            $stmt = $this->db->prepare("
                SELECT image_url FROM property_images 
                WHERE property_id = ? 
                ORDER BY image_id ASC 
                LIMIT 1
            ");
            $stmt->execute([$propertyId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['image_url'] ?? null;
        } catch (PDOException $e) {
            error_log("Get main image failed: " . $e->getMessage());
            return null;
        }
    }

    // Count images for property
    public function countByProperty($propertyId) {
        try {
            $stmt = $this->db->prepare("
                SELECT COUNT(*) as cnt FROM property_images WHERE property_id = ?
            ");
            $stmt->execute([$propertyId]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['cnt'] ?? 0;
        } catch (PDOException $e) {
            error_log("Count property images failed: " . $e->getMessage());
            return 0;
        }
    }
}