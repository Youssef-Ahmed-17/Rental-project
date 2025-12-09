<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../core/Controller.php';

class AuthController extends Controller {

    private $baseUrl = "/Rental_project/public/?url=";

    public function register() {
        $this->view('auth/register');
    }

    public function login() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = $this->model('User');

            // البحث عن المستخدم بالبريد
            $stmt = $userModel->db->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {

                // حفظ بيانات السيشن
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role']   = $user['role'];
                $_SESSION['name']   = $user['name'];

                // توجيه حسب الدور
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

                // بيانات خاطئة
                $data = ['error' => 'Invalid email or password'];
                $this->view('auth/login', $data);
            }

        } else {
            // GET - إظهار صفحة تسجيل الدخول
            $this->view('auth/login');
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: " . $this->baseUrl . "AuthController/login");
        exit;
    }

    public function store() {
        $user = new User();

        // التحقق من البريد
        if ($user->emailExists($_POST['email'])) {
            header("Location: /Rental_project/public/AuthController/register?error=Email already exists");
            exit();
        }

        // إنشاء مستخدم
        $created = $user->create([
            "role"        => $_POST['role'],
            "name"        => $_POST['name'],
            "email"       => $_POST['email'],
            "password"    => $_POST['password'],
            "national_id" => $_POST['national_id'],
            "city"        => $_POST['city'],
            "phone"       => $_POST['phone']
        ]);

        // نجاح
        if ($created) {
            header("Location: /Rental_project/public/AuthController/login");
            exit();
        }

        // فشل
        header("Location: /Rental_project/public/AuthController/register?error=Failed to create user");
        exit();
    }
}
