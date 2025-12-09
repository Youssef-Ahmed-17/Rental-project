<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../core/Controller.php';

class AuthController extends Controller {

    public function register() {
        $this->view('<auth/register');
    }

    public function login() {
        $this->view('auth/login'); 
        }


    public function store() {
    $user = new User();

    if ($user->emailExists($_POST['email'])) {
        header("Location: /Rental_project/public/AuthController/register?error=Email already exists");
        exit();
    }

    $created = $user->create([
        "role" => $_POST['role'],
        "name" => $_POST['name'],
        "email" => $_POST['email'],
        "password" => $_POST['password'],
        "national_id" => $_POST['national_id'],
        "city" => $_POST['city'],
        "phone" => $_POST['phone']
    ]);

    if($created){
        // Redirect to login page after successful registration
        header("Location: /Rental_project/public/AuthController/login");
        exit();
    } else {
        header("Location: /Rental_project/public/AuthController/register?error=Failed to create user");
        exit();
    }
}

}
