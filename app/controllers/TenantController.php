<?php
require_once __DIR__ . '/../core/Controller.php';

// Session check at the top
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class TenantController extends Controller {

    public function __construct() {
        // Check if user is logged in and is tenant
        if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'tenant') {
            header('Location: /Rental_project/public/?url=AuthController/login');
            exit;
        }
    }

    // Main tenant wall - property listings
    public function tenantWall() {
        $propertyModel = $this->model('Property');
        $savedModel = $this->model('SavedProperty');
        
        $properties = $propertyModel->all();
        $totalCount = $propertyModel->countAvailable();
        
        // Add view count and saved status to each property
        foreach ($properties as &$property) {
            $property['view_count'] = $propertyModel->getViewCount($property['property_id']);
            $property['is_saved'] = $savedModel->isSaved($_SESSION['user_id'], $property['property_id']);
        }
        
        $data = [
            'name' => $_SESSION['name'] ?? 'Tenant',
            'properties' => $properties,
            'total_count' => $totalCount
        ];
        
        $this->view('tenant/tenantWall', $data);
    }

    // Property details page
    public function propertyDetails($id = null) {
        // Get ID from parameter or GET
        if (!$id && isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        
        if (!$id) {
            header('Location: index.php?url=TenantController/tenantWall');
            exit;
        }

        $propertyModel = $this->model('Property');
        $imageModel = $this->model('PropertyImage');
        $applicationModel = $this->model('Application');
        $savedModel = $this->model('SavedProperty');
        
        $property = $propertyModel->find($id);
        
        if (!$property) {
            header('Location: index.php?url=TenantController/tenantWall');
            exit;
        }
        
        // Increment view count
        $propertyModel->incrementViews($id, $_SESSION['user_id']);
        
        $images = $imageModel->findByProperty($id);
        $viewCount = $propertyModel->getViewCount($id);
        $hasApplied = $applicationModel->hasApplied($id, $_SESSION['user_id']);
        $isSaved = $savedModel->isSaved($_SESSION['user_id'], $id);
        
        $data = [
            'property' => $property,
            'images' => $images,
            'view_count' => $viewCount,
            'has_applied' => $hasApplied,
            'is_saved' => $isSaved
        ];
        
        $this->view('tenant/propertyDetails', $data);
    }

    // Apply for property
    public function propertyApply($id = null) {
        // Get ID from parameter or GET
        if (!$id && isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        
        if (!$id) {
            header('Location: index.php?url=TenantController/tenantWall');
            exit;
        }

        $propertyModel = $this->model('Property');
        $applicationModel = $this->model('Application');
        
        // Check if already applied
        if ($applicationModel->hasApplied($id, $_SESSION['user_id'])) {
            $_SESSION['error'] = 'You have already applied for this property.';
            header("Location: index.php?url=TenantController/propertyDetails/{$id}");
            exit;
        }

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $applicationModel->create([
                'property_id' => $id,
                'tenant_id' => $_SESSION['user_id'],
                'message' => $_POST['message'] ?? ''
            ]);

            $_SESSION['success'] = 'Application submitted successfully!';
            header("Location: index.php?url=TenantController/tenantWall");
            exit;
        }

        // Show apply form
        $property = $propertyModel->find($id);
        
        if (!$property) {
            header('Location: index.php?url=TenantController/tenantWall');
            exit;
        }

        $data = [
            'property' => $property,
            'user' => [
                'name' => $_SESSION['name'] ?? '',
                'email' => $_SESSION['email'] ?? '',
                'phone' => $_SESSION['phone'] ?? ''
            ]
        ];
        
        $this->view('tenant/propertyApply', $data);
    }

    // Saved properties page
    public function savedProperties() {
        $savedModel = $this->model('SavedProperty');
        $properties = $savedModel->getByTenant($_SESSION['user_id']);
        $count = $savedModel->count($_SESSION['user_id']);
        
        // Add view count to each property
        $propertyModel = $this->model('Property');
        foreach ($properties as &$property) {
            $property['view_count'] = $propertyModel->getViewCount($property['property_id']);
        }
        
        $data = [
            'properties' => $properties,
            'saved_count' => $count
        ];
        
        $this->view('tenant/savedProperties', $data);
    }

    // Toggle save property (AJAX)
    public function toggleSave() {
        header('Content-Type: application/json');
        
        if (!isset($_GET['property_id'])) {
            echo json_encode(['success' => false, 'message' => 'Property ID required']);
            exit;
        }
        
        $propertyId = (int)$_GET['property_id'];
        $savedModel = $this->model('SavedProperty');
        
        if ($savedModel->isSaved($_SESSION['user_id'], $propertyId)) {
            $savedModel->remove($_SESSION['user_id'], $propertyId);
            echo json_encode(['success' => true, 'saved' => false]);
        } else {
            $savedModel->save($_SESSION['user_id'], $propertyId);
            echo json_encode(['success' => true, 'saved' => true]);
        }
        exit;
    }

    // Notifications page
    public function tenantNotifications() {
        $applicationModel = $this->model('Application');
        $applications = $applicationModel->getByTenant($_SESSION['user_id']);
        
        $data = [
            'applications' => $applications,
            'pending_count' => $applicationModel->countByStatus($_SESSION['user_id'], 'pending'),
            'accepted_count' => $applicationModel->countByStatus($_SESSION['user_id'], 'accepted'),
            'rejected_count' => $applicationModel->countByStatus($_SESSION['user_id'], 'rejected')
        ];
        
        $this->view('tenant/tenantNotifications', $data);
    }

    // Search properties (AJAX or regular)
    public function search() {
        $query = $_GET['q'] ?? '';
        
        $propertyModel = $this->model('Property');
        $properties = $query ? $propertyModel->search($query) : $propertyModel->all();
        
        // If AJAX request, return JSON
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode(['properties' => $properties]);
            exit;
        }
        
        // Otherwise redirect to wall with search results
        $this->tenantWall();
    }
}