<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../core/Controller.php';

// Session check at the top
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class AuthController extends Controller {

    private $baseUrl = "/Rental_project/public/?url=";

    public function register() {
        $this->view('auth/register');
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = $this->model('User');

            // Search for user by email
            $stmt = $userModel->db->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {

                // Regenerate session ID for security
                session_regenerate_id(true);

                // Save session data
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role']   = $user['role'];
                $_SESSION['name']   = $user['name'];

                // Redirect based on role
                switch ($user['role']) {

                    case 'tenant':
                        header("Location: " . $this->baseUrl . "TenantController/tenantWall");
                        exit;

                    case 'landlord':
                        header("Location: " . $this->baseUrl . "LandlordController/landlordDashboard");
                        exit;

                    case 'admin':
                        header("Location: " . $this->baseUrl . "AdminController/dashboard");
                        exit;

                    default:
                        header("Location: " . $this->baseUrl . "AuthController/login");
                        exit;
                }

            } else {

                // Invalid credentials
                $data = ['error' => 'Invalid email or password'];
                $this->view('auth/login', $data);
            }

        } else {
            // GET - Show login page
            $this->view('auth/login');
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: " . $this->baseUrl . "AuthController/login");
        exit;
    }

    public function store() {
        $user = new User();

        // Check if email exists
        if ($user->emailExists($_POST['email'])) {
            header("Location: /Rental_project/public/?url=AuthController/register&error=Email already exists");
            exit();
        }

        // Create user
        $created = $user->create([
            "role"        => $_POST['role'],
            "name"        => $_POST['name'],
            "email"       => $_POST['email'],
            "password"    => $_POST['password'],
            "national_id" => $_POST['national_id'],
            "city"        => $_POST['city'],
            "phone"       => $_POST['phone']
        ]);

        // Success
        if ($created) {
            header("Location: /Rental_project/public/?url=AuthController/login");
            exit();
        }

        // Failed
        header("Location: /Rental_project/public/?url=AuthController/register&error=Failed to create user");
        exit();
    }
}