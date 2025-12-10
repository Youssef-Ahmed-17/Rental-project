<?php
require_once __DIR__ . '/../core/Database.php';

class Property {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    // Get all available properties
    public function all() {
        try {
            $stmt = $this->db->query("
                SELECT p.*, u.name as landlord_name, u.phone as landlord_phone,
                       (SELECT image_url FROM property_images WHERE property_id = p.property_id LIMIT 1) as main_image
                FROM properties p
                JOIN users u ON p.landlord_id = u.id
                WHERE p.status = 'available'
                ORDER BY p.property_id DESC
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Get all properties failed: " . $e->getMessage());
            return [];
        }
    }

    // Get property by ID
    public function find($id) {
        try {
            $stmt = $this->db->prepare("
                SELECT p.*, u.name as landlord_name, u.phone as landlord_phone, u.email as landlord_email
                FROM properties p
                JOIN users u ON p.landlord_id = u.id
                WHERE p.property_id = ?
            ");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Find property failed: " . $e->getMessage());
            return null;
        }
    }

    // Search properties
    public function search($query) {
        try {
            $searchTerm = "%{$query}%";
            $stmt = $this->db->prepare("
                SELECT p.*, u.name as landlord_name,
                       (SELECT image_url FROM property_images WHERE property_id = p.property_id LIMIT 1) as main_image
                FROM properties p
                JOIN users u ON p.landlord_id = u.id
                WHERE p.status = 'available' 
                AND (p.title LIKE ? OR p.city LIKE ? OR p.address LIKE ?)
                ORDER BY p.property_id DESC
            ");
            $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Search properties failed: " . $e->getMessage());
            return [];
        }
    }

    // Get properties by city
    public function getByCity($city) {
        try {
            $stmt = $this->db->prepare("
                SELECT p.*, u.name as landlord_name,
                       (SELECT image_url FROM property_images WHERE property_id = p.property_id LIMIT 1) as main_image
                FROM properties p
                JOIN users u ON p.landlord_id = u.id
                WHERE p.status = 'available' AND p.city = ?
                ORDER BY p.property_id DESC
            ");
            $stmt->execute([$city]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Get properties by city failed: " . $e->getMessage());
            return [];
        }
    }

    // Count total available properties
    public function countAvailable() {
        try {
            $stmt = $this->db->query("SELECT COUNT(*) as cnt FROM properties WHERE status = 'available'");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['cnt'] ?? 0;
        } catch (PDOException $e) {
            error_log("Count properties failed: " . $e->getMessage());
            return 0;
        }
    }

    // Increment view count
    public function incrementViews($propertyId, $userId = null) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO property_views (property_id, user_id, viewed_at) 
                VALUES (?, ?, NOW())
            ");
            return $stmt->execute([$propertyId, $userId]);
        } catch (PDOException $e) {
            error_log("Increment views failed: " . $e->getMessage());
            return false;
        }
    }

    // Get view count for property
    public function getViewCount($propertyId) {
        try {
            $stmt = $this->db->prepare("
                SELECT COUNT(*) as cnt FROM property_views WHERE property_id = ?
            ");
            $stmt->execute([$propertyId]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['cnt'] ?? 0;
        } catch (PDOException $e) {
            error_log("Get view count failed: " . $e->getMessage());
            return 0;
        }
    }

    // ========== NEW LANDLORD METHODS ==========

    // Get all properties by landlord ID
    public function getByLandlord($landlordId) {
        try {
            $stmt = $this->db->prepare("
                SELECT p.*, 
                       (SELECT image_url FROM property_images WHERE property_id = p.property_id LIMIT 1) as main_image,
                       (SELECT COUNT(*) FROM property_views WHERE property_id = p.property_id) as view_count,
                       (SELECT COUNT(*) FROM applications WHERE property_id = p.property_id AND status = 'pending') as pending_applications
                FROM properties p
                WHERE p.landlord_id = ? 
                ORDER BY p.property_id DESC
            ");
            $stmt->execute([$landlordId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Get properties by landlord failed: " . $e->getMessage());
            return [];
        }
    }

    // Count total properties by landlord
    public function countByLandlord($landlordId) {
        try {
            $stmt = $this->db->prepare("
                SELECT COUNT(*) as cnt 
                FROM properties 
                WHERE landlord_id = ?
            ");
            $stmt->execute([$landlordId]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['cnt'] ?? 0;
        } catch (PDOException $e) {
            error_log("Count properties by landlord failed: " . $e->getMessage());
            return 0;
        }
    }

    // Count rented properties by landlord
    public function countRentedByLandlord($landlordId) {
        try {
            $stmt = $this->db->prepare("
                SELECT COUNT(*) as cnt 
                FROM properties 
                WHERE landlord_id = ? AND status = 'rented'
            ");
            $stmt->execute([$landlordId]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['cnt'] ?? 0;
        } catch (PDOException $e) {
            error_log("Count rented properties by landlord failed: " . $e->getMessage());
            return 0;
        }
    }

    // Create new property
    public function create($data) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO properties 
                (landlord_id, title, description, city, address, bedroom, bathroom, area_sqft, floor, monthly_rent, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            
            $success = $stmt->execute([
                $data['landlord_id'],
                $data['title'],
                $data['description'],
                $data['city'],
                $data['address'],
                $data['bedroom'],
                $data['bathroom'],
                $data['area_sqft'],
                $data['floor'],
                $data['monthly_rent'],
                $data['status']
            ]);

            return $success ? $this->db->lastInsertId() : false;
        } catch (PDOException $e) {
            error_log("Create property failed: " . $e->getMessage());
            return false;
        }
    }

    // Update property
    public function update($id, $data) {
        try {
            $stmt = $this->db->prepare("
                UPDATE properties 
                SET title = ?, description = ?, city = ?, address = ?, 
                    bedroom = ?, bathroom = ?, area_sqft = ?, floor = ?, 
                    monthly_rent = ?, status = ?
                WHERE property_id = ?
            ");
            
            return $stmt->execute([
                $data['title'],
                $data['description'],
                $data['city'],
                $data['address'],
                $data['bedroom'],
                $data['bathroom'],
                $data['area_sqft'],
                $data['floor'],
                $data['monthly_rent'],
                $data['status'],
                $id
            ]);
        } catch (PDOException $e) {
            error_log("Update property failed: " . $e->getMessage());
            return false;
        }
    }

    // Delete property
    public function delete($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM properties WHERE property_id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Delete property failed: " . $e->getMessage());
            return false;
        }
    }

    // ========== ADMIN APPROVAL METHODS ==========

    // Get all pending properties for admin approval
    public function getPendingProperties() {
        try {
            $stmt = $this->db->query("
                SELECT p.*, u.name as landlord_name, u.email as landlord_email, u.phone as landlord_phone,
                       (SELECT image_url FROM property_images WHERE property_id = p.property_id LIMIT 1) as main_image
                FROM properties p
                JOIN users u ON p.landlord_id = u.id
                WHERE p.status = 'pending'
                ORDER BY p.property_id DESC
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Get pending properties failed: " . $e->getMessage());
            return [];
        }
    }

    // Count properties by status
    public function countByStatus($status) {
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) as cnt FROM properties WHERE status = ?");
            $stmt->execute([$status]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['cnt'] ?? 0;
        } catch (PDOException $e) {
            error_log("Count properties by status failed: " . $e->getMessage());
            return 0;
        }
    }

    // Count all properties
    public function countAll() {
        try {
            $stmt = $this->db->query("SELECT COUNT(*) as cnt FROM properties");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['cnt'] ?? 0;
        } catch (PDOException $e) {
            error_log("Count all properties failed: " . $e->getMessage());
            return 0;
        }
    }

    // Update property status (for admin approval/rejection)
    public function updateStatus($id, $status) {
        try {
            $stmt = $this->db->prepare("UPDATE properties SET status = ? WHERE property_id = ?");
            return $stmt->execute([$status, $id]);
        } catch (PDOException $e) {
            error_log("Update property status failed: " . $e->getMessage());
            return false;
        }
    }
}