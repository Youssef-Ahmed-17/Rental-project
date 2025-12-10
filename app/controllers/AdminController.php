<?php
// Session check at the top
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class AdminController extends Controller {

    public function __construct() {
        // Check if user is logged in and is admin
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: /Rental_project/public/?url=AuthController/login');
            exit;
        }
    }

    public function dashboard() {
        $user = $this->model('User');
        $property = $this->model('Property');
        $application = $this->model('Application');

        $data = [
            'registeredUsers' => $user->countByStatus(),
            'totalProperties' => $property->countAll(),
            'pendingProperties' => $property->countByStatus('pending'),
            'approvedProperties' => $property->countByStatus('available'),
            'rejectedProperties' => $property->countByStatus('rejected'),
            'rentedProperties' => $property->countByStatus('rented')
        ];

        $this->view('admin/adminDashboard', $data);
    }

    public function manageUsers() {
        $user = $this->model('User');
        $users = $user->getAll();
        $this->view('admin/manageUsers', ['users' => $users]);
    }

    public function managePosts() {
        $property = $this->model('Property');
        
        // Get all properties with counts
        $pendingProperties = $property->getPendingProperties();
        $totalPosts = $property->countAll();
        $approvedPosts = $property->countByStatus('available');
        $rejectedPosts = $property->countByStatus('rejected');
        
        $data = [
            'posts' => $pendingProperties,
            'total_posts' => $totalPosts,
            'approved_posts' => $approvedPosts,
            'inactive_posts' => $rejectedPosts
        ];
        
        $this->view('admin/managePosts', $data);
    }

    public function manageRequests() {
        $application = $this->model('Application');
        // If you have a method to get all applications for admin
        $this->view('admin/manageRequests');
    }

    // Approve property - change status from 'pending' to 'available'
    public function approveProperty() {
        if (!isset($_GET['id'])) {
            $_SESSION['error'] = 'Property ID not provided';
            header('Location: index.php?url=AdminController/managePosts');
            exit;
        }

        $propertyId = $_GET['id'];
        $property = $this->model('Property');

        if ($property->updateStatus($propertyId, 'available')) {
            $_SESSION['success'] = 'Property approved successfully! It will now appear on tenant wall.';
        } else {
            $_SESSION['error'] = 'Failed to approve property';
        }

        header('Location: index.php?url=AdminController/managePosts');
        exit;
    }

    // Reject property
    public function rejectProperty() {
        if (!isset($_GET['id'])) {
            $_SESSION['error'] = 'Property ID not provided';
            header('Location: index.php?url=AdminController/managePosts');
            exit;
        }

        $propertyId = $_GET['id'];
        $property = $this->model('Property');

        if ($property->updateStatus($propertyId, 'rejected')) {
            $_SESSION['success'] = 'Property rejected successfully!';
        } else {
            $_SESSION['error'] = 'Failed to reject property';
        }

        header('Location: index.php?url=AdminController/managePosts');
        exit;
    }

    // AJAX endpoint to update status
    public function updateStatus() {
        header('Content-Type: application/json');
        
        if (isset($_GET['action'], $_GET['id'], $_GET['status'])) {
            $action = $_GET['action'];
            $id     = (int)$_GET['id'];
            $status = $_GET['status'];

            try {
                switch ($action) {
                    case 'updateUserStatus':
                        $this->model('User')->updateStatus($id, $status);
                        break;
                    case 'updatePropertyStatus':
                        $this->model('Property')->updateStatus($id, $status);
                        break;
                    case 'updateApplicationStatus':
                        $this->model('Application')->updateStatus($id, $status);
                        break;
                    default:
                        echo json_encode(['success' => false, 'message' => 'Invalid action']);
                        exit;
                }

                echo json_encode(['success' => true]);
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Missing parameters']);
        }
        exit;
    }
}