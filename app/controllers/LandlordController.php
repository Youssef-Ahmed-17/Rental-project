<?php
require_once __DIR__ . '/../core/Controller.php';

// Session check at the top
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class LandlordController extends Controller {

    public function __construct() {
        // Check if user is logged in and is landlord
        if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'landlord') {
            header('Location: /Rental_project/public/?url=AuthController/login');
            exit;
        }
    }

    // Dashboard
    public function landlordDashboard() {
        $propertyModel = $this->model('Property');
        $applicationModel = $this->model('Application');
        
        $properties = $propertyModel->getByLandlord($_SESSION['user_id']);
        $totalProperties = $propertyModel->countByLandlord($_SESSION['user_id']);
        $rentedProperties = $propertyModel->countRentedByLandlord($_SESSION['user_id']);
        $pendingApplications = $applicationModel->countPendingForLandlord($_SESSION['user_id']);
        
        $data = [
            'name' => $_SESSION['name'] ?? 'Landlord',
            'properties' => $properties,
            'total_properties' => $totalProperties,
            'rented_properties' => $rentedProperties,
            'pending_applications' => $pendingApplications
        ];
        
        $this->view('landlord/dashboard', $data);
    }

    // Show create property form
    public function createProperty() {
        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $propertyModel = $this->model('Property');
            $imageModel = $this->model('PropertyImage');
            
            // Validate required fields
            if(empty($_POST['title']) || empty($_POST['monthly_rent'])) {
                $_SESSION['error'] = 'Please fill all required fields';
                header('Location: index.php?url=LandlordController/createProperty');
                exit;
            }
            
            // Create property
            $propertyData = [
                'landlord_id' => $_SESSION['user_id'],
                'title' => $_POST['title'],
                'description' => $_POST['description'] ?? '',
                'city' => $_POST['city'],
                'address' => $_POST['address'] ?? '',
                'bedroom' => $_POST['bedroom'] ?? 1,
                'bathroom' => $_POST['bathroom'] ?? 1,
                'area_sqft' => $_POST['area_sqft'] ?? 0,
                'floor' => $_POST['floor'] ?? null,
                'monthly_rent' => $_POST['monthly_rent'],
                'status' => 'pending'  // Always set to pending for admin approval
            ];
            
            $propertyId = $propertyModel->create($propertyData);
            
            if ($propertyId) {
                // Handle image uploads
                if(isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
                    $uploadedImages = $this->handleImageUpload($_FILES['images'], $propertyId);
                    
                    // Save image paths to database
                    foreach($uploadedImages as $imagePath) {
                        $imageModel->create([
                            'property_id' => $propertyId,
                            'image_url' => $imagePath
                        ]);
                    }
                }
                
                $_SESSION['success'] = 'Property added successfully!';
                header('Location: index.php?url=LandlordController/landlordDashboard');
                exit;
            } else {
                $_SESSION['error'] = 'Failed to add property';
            }
        }
        
        // Show form
        $this->view('landlord/createProperty');
    }

    // Handle multiple image uploads
    private function handleImageUpload($files, $propertyId) {
        $uploadedFiles = [];
        $uploadDir = __DIR__ . '/../../public/uploads/properties/';
        
        // Create directory if it doesn't exist
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $fileCount = count($files['name']);
        
        for ($i = 0; $i < $fileCount; $i++) {
            if ($files['error'][$i] === UPLOAD_ERR_OK) {
                $tmpName = $files['tmp_name'][$i];
                $fileName = $files['name'][$i];
                $fileSize = $files['size'][$i];
                $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                
                // Validate file type
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                if (!in_array($fileExt, $allowedTypes)) {
                    continue;
                }
                
                // Validate file size (5MB max)
                if ($fileSize > 5 * 1024 * 1024) {
                    continue;
                }
                
                // Generate unique filename
                $newFileName = 'property_' . $propertyId . '_' . time() . '_' . $i . '.' . $fileExt;
                $destination = $uploadDir . $newFileName;
                
                // Move uploaded file
                if (move_uploaded_file($tmpName, $destination)) {
                    // Store relative path for database
                    $uploadedFiles[] = 'uploads/properties/' . $newFileName;
                }
            }
        }
        
        return $uploadedFiles;
    }

    // Edit property
    public function editProperty($id = null) {
        if (!$id && isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        
        if (!$id) {
            header('Location: index.php?url=LandlordController/landlordDashboard');
            exit;
        }
        
        $propertyModel = $this->model('Property');
        $property = $propertyModel->find($id);
        
        // Verify ownership
        if (!$property || $property['landlord_id'] != $_SESSION['user_id']) {
            header('Location: index.php?url=LandlordController/landlordDashboard');
            exit;
        }
        
        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $propertyData = [
                'title' => $_POST['title'],
                'description' => $_POST['description'] ?? '',
                'city' => $_POST['city'],
                'address' => $_POST['address'] ?? '',
                'bedroom' => $_POST['bedroom'] ?? 1,
                'bathroom' => $_POST['bathroom'] ?? 1,
                'area_sqft' => $_POST['area_sqft'] ?? 0,
                'floor' => $_POST['floor'] ?? null,
                'monthly_rent' => $_POST['monthly_rent'],
                'status' => $_POST['status'] ?? 'available'
            ];
            
            if ($propertyModel->update($id, $propertyData)) {
                // Handle new image uploads if any
                if(isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
                    $imageModel = $this->model('PropertyImage');
                    $uploadedImages = $this->handleImageUpload($_FILES['images'], $id);
                    
                    foreach($uploadedImages as $imagePath) {
                        $imageModel->create([
                            'property_id' => $id,
                            'image_url' => $imagePath
                        ]);
                    }
                }
                
                $_SESSION['success'] = 'Property updated successfully!';
                header('Location: index.php?url=LandlordController/landlordDashboard');
                exit;
            } else {
                $_SESSION['error'] = 'Failed to update property';
            }
        }
        
        $imageModel = $this->model('PropertyImage');
        $images = $imageModel->findByProperty($id);
        
        $data = [
            'property' => $property,
            'images' => $images
        ];
        
        $this->view('landlord/editProperty', $data);
    }

    // Delete property image
    public function deleteImage() {
        if (!isset($_GET['image_id'])) {
            header('Location: index.php?url=LandlordController/landlordDashboard');
            exit;
        }
        
        $imageId = $_GET['image_id'];
        $propertyId = $_GET['property_id'] ?? null;
        
        $imageModel = $this->model('PropertyImage');
        
        // Get image before deleting
        $images = $imageModel->findByProperty($propertyId);
        $image = null;
        foreach ($images as $img) {
            if ($img['image_id'] == $imageId) {
                $image = $img;
                break;
            }
        }
        
        if ($image) {
            // Delete physical file
            $filePath = __DIR__ . '/../../public/' . $image['image_url'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            
            // Delete from database
            $imageModel->delete($imageId);
        }
        
        if ($propertyId) {
            header("Location: index.php?url=LandlordController/editProperty/{$propertyId}");
        } else {
            header('Location: index.php?url=LandlordController/landlordDashboard');
        }
        exit;
    }

    // Delete property
    public function deleteProperty($id = null) {
        if (!$id && isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        
        if (!$id) {
            header('Location: index.php?url=LandlordController/landlordDashboard');
            exit;
        }
        
        $propertyModel = $this->model('Property');
        $property = $propertyModel->find($id);
        
        // Verify ownership
        if (!$property || $property['landlord_id'] != $_SESSION['user_id']) {
            header('Location: index.php?url=LandlordController/landlordDashboard');
            exit;
        }
        
        // Delete property images
        $imageModel = $this->model('PropertyImage');
        $images = $imageModel->findByProperty($id);
        
        foreach ($images as $image) {
            $filePath = __DIR__ . '/../../public/' . $image['image_url'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        
        $imageModel->deleteByProperty($id);
        
        // Delete property
        if ($propertyModel->delete($id)) {
            $_SESSION['success'] = 'Property deleted successfully!';
        } else {
            $_SESSION['error'] = 'Failed to delete property';
        }
        
        header('Location: index.php?url=LandlordController/landlordDashboard');
        exit;
    }

    // View proposals/applications
    public function proposals() {
        $applicationModel = $this->model('Application');
        $applications = $applicationModel->getByLandlord($_SESSION['user_id']);
        
        $data = [
            'applications' => $applications
        ];
        
        $this->view('landlord/proposals', $data);
    }

    // Update application status
    public function updateApplicationStatus() {
        if (!isset($_POST['application_id']) || !isset($_POST['status'])) {
            header('Location: index.php?url=LandlordController/proposals');
            exit;
        }
        
        $applicationModel = $this->model('Application');
        $status = $_POST['status']; // 'accepted' or 'rejected'
        $applicationId = $_POST['application_id'];
        
        if ($applicationModel->updateStatus($applicationId, $status)) {
            $_SESSION['success'] = 'Application ' . $status . ' successfully!';
        } else {
            $_SESSION['error'] = 'Failed to update application';
        }
        
        header('Location: index.php?url=LandlordController/proposals');
        exit;
    }

    // Notifications
    public function landlordNotifications() {
        $applicationModel = $this->model('Application');
        $recentApplications = $applicationModel->getByLandlord($_SESSION['user_id']);
        
        $data = [
            'applications' => array_slice($recentApplications, 0, 10) // Last 10
        ];
        
        $this->view('landlord/landlordNotifications', $data);
    }
}