<?php
require_once __DIR__ . '/../core/Database.php';

class SavedProperty {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    // Save property
    public function save($tenantId, $propertyId) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO saved_properties (tenant_id, property_id, saved_at) 
                VALUES (?, ?, NOW())
            ");
            return $stmt->execute([$tenantId, $propertyId]);
        } catch (PDOException $e) {
            error_log("Save property failed: " . $e->getMessage());
            return false;
        }
    }

    // Remove saved property
    public function remove($tenantId, $propertyId) {
        try {
            $stmt = $this->db->prepare("
                DELETE FROM saved_properties 
                WHERE tenant_id = ? AND property_id = ?
            ");
            return $stmt->execute([$tenantId, $propertyId]);
        } catch (PDOException $e) {
            error_log("Remove saved property failed: " . $e->getMessage());
            return false;
        }
    }

    // Check if property is saved
    public function isSaved($tenantId, $propertyId) {
        try {
            $stmt = $this->db->prepare("
                SELECT saved_id FROM saved_properties 
                WHERE tenant_id = ? AND property_id = ?
            ");
            $stmt->execute([$tenantId, $propertyId]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Check saved property failed: " . $e->getMessage());
            return false;
        }
    }

    // Get all saved properties for tenant
    public function getByTenant($tenantId) {
        try {
            $stmt = $this->db->prepare("
                SELECT p.*, sp.saved_at, u.name as landlord_name,
                       (SELECT image_url FROM property_images WHERE property_id = p.property_id LIMIT 1) as main_image
                FROM saved_properties sp
                JOIN properties p ON sp.property_id = p.property_id
                JOIN users u ON p.landlord_id = u.id
                WHERE sp.tenant_id = ?
                ORDER BY sp.saved_at DESC
            ");
            $stmt->execute([$tenantId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Get saved properties failed: " . $e->getMessage());
            return [];
        }
    }

    // Count saved properties
    public function count($tenantId) {
        try {
            $stmt = $this->db->prepare("
                SELECT COUNT(*) as cnt FROM saved_properties WHERE tenant_id = ?
            ");
            $stmt->execute([$tenantId]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['cnt'] ?? 0;
        } catch (PDOException $e) {
            error_log("Count saved properties failed: " . $e->getMessage());
            return 0;
        }
    }
}