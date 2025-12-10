<?php
require_once __DIR__ . '/../core/Database.php';

class Application {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    // Create new application
    public function create($data) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO applications (property_id, tenant_id, message, status, applied_at) 
                VALUES (?, ?, ?, 'pending', NOW())
            ");
            return $stmt->execute([
                $data['property_id'],
                $data['tenant_id'],
                $data['message'] ?? ''
            ]);
        } catch (PDOException $e) {
            error_log("Create application failed: " . $e->getMessage());
            return false;
        }
    }

    // Check if tenant has already applied
    public function hasApplied($propertyId, $tenantId) {
        try {
            $stmt = $this->db->prepare("
                SELECT application_id FROM applications 
                WHERE property_id = ? AND tenant_id = ?
            ");
            $stmt->execute([$propertyId, $tenantId]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Check application failed: " . $e->getMessage());
            return false;
        }
    }

    // Get applications by tenant
    public function getByTenant($tenantId) {
        try {
            $stmt = $this->db->prepare("
                SELECT a.*, p.title, p.city, p.address, p.monthly_rent,
                       (SELECT image_url FROM property_images WHERE property_id = p.property_id LIMIT 1) as main_image
                FROM applications a
                JOIN properties p ON a.property_id = p.property_id
                WHERE a.tenant_id = ?
                ORDER BY a.applied_at DESC
            ");
            $stmt->execute([$tenantId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Get tenant applications failed: " . $e->getMessage());
            return [];
        }
    }

    // Get applications by landlord (for property owner)
    public function getByLandlord($landlordId) {
        try {
            $stmt = $this->db->prepare("
                SELECT a.*, p.title, p.city, p.monthly_rent,
                       u.name as tenant_name, u.email as tenant_email, u.phone as tenant_phone,
                       (SELECT image_url FROM property_images WHERE property_id = p.property_id LIMIT 1) as main_image
                FROM applications a
                JOIN properties p ON a.property_id = p.property_id
                JOIN users u ON a.tenant_id = u.id
                WHERE p.landlord_id = ?
                ORDER BY a.applied_at DESC
            ");
            $stmt->execute([$landlordId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Get landlord applications failed: " . $e->getMessage());
            return [];
        }
    }

    // Get applications by property
    public function getByProperty($propertyId) {
        try {
            $stmt = $this->db->prepare("
                SELECT a.*, u.name as tenant_name, u.email as tenant_email, u.phone as tenant_phone
                FROM applications a
                JOIN users u ON a.tenant_id = u.id
                WHERE a.property_id = ?
                ORDER BY a.applied_at DESC
            ");
            $stmt->execute([$propertyId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Get property applications failed: " . $e->getMessage());
            return [];
        }
    }

    // Update application status
    public function updateStatus($applicationId, $status) {
        try {
            $stmt = $this->db->prepare("
                UPDATE applications 
                SET status = ?, updated_at = NOW() 
                WHERE application_id = ?
            ");
            return $stmt->execute([$status, $applicationId]);
        } catch (PDOException $e) {
            error_log("Update application status failed: " . $e->getMessage());
            return false;
        }
    }

    // Count applications by status for tenant
    public function countByStatus($tenantId, $status) {
        try {
            $stmt = $this->db->prepare("
                SELECT COUNT(*) as cnt FROM applications 
                WHERE tenant_id = ? AND status = ?
            ");
            $stmt->execute([$tenantId, $status]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['cnt'] ?? 0;
        } catch (PDOException $e) {
            error_log("Count applications by status failed: " . $e->getMessage());
            return 0;
        }
    }

    // Count total applications for tenant
    public function countByTenant($tenantId) {
        try {
            $stmt = $this->db->prepare("
                SELECT COUNT(*) as cnt FROM applications WHERE tenant_id = ?
            ");
            $stmt->execute([$tenantId]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['cnt'] ?? 0;
        } catch (PDOException $e) {
            error_log("Count tenant applications failed: " . $e->getMessage());
            return 0;
        }
    }

    // Count pending applications for landlord
    public function countPendingForLandlord($landlordId) {
        try {
            $stmt = $this->db->prepare("
                SELECT COUNT(*) as cnt FROM applications a
                JOIN properties p ON a.property_id = p.property_id
                WHERE p.landlord_id = ? AND a.status = 'pending'
            ");
            $stmt->execute([$landlordId]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['cnt'] ?? 0;
        } catch (PDOException $e) {
            error_log("Count pending applications failed: " . $e->getMessage());
            return 0;
        }
    }

    // Delete application
    public function delete($applicationId) {
        try {
            $stmt = $this->db->prepare("
                DELETE FROM applications WHERE application_id = ?
            ");
            return $stmt->execute([$applicationId]);
        } catch (PDOException $e) {
            error_log("Delete application failed: " . $e->getMessage());
            return false;
        }
    }

    // Get single application
    public function find($applicationId) {
        try {
            $stmt = $this->db->prepare("
                SELECT a.*, p.title, p.city, p.monthly_rent,
                       u.name as tenant_name, u.email as tenant_email, u.phone as tenant_phone
                FROM applications a
                JOIN properties p ON a.property_id = p.property_id
                JOIN users u ON a.tenant_id = u.id
                WHERE a.application_id = ?
            ");
            $stmt->execute([$applicationId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Find application failed: " . $e->getMessage());
            return null;
        }
    }
}