<?php
// app/controllers/AuthController.php
class AuthController extends Controller {
    private $userModel;
    private $roleModel;
    public function __construct(){
        $this->userModel = new User($this->db);
        $this->roleModel = new Role($this->db);
    }

    public function login(){
        if($_POST){
            $user = $this->userModel->findByEmail($_POST['email']);
            if($user && password_verify($_POST['password'], $user['password'])){
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['role_id'] = $user['role_id'];
                header("Location: /dashboard"); exit;
            } else { echo "Invalid credentials"; }
        }
        $this->view('auth/login');
    }

    public function register(){
        if($_POST){
            $data = [
                'full_name'=>$_POST['full_name'],
                'email'=>$_POST['email'],
                'password'=>password_hash($_POST['password'],PASSWORD_DEFAULT),
                'role_id'=>$_POST['role_id'],
                'phone'=>$_POST['phone'],
                'city'=>$_POST['city'],
                'national_id'=>$_POST['national_id']
            ];
            $this->userModel->create($data);
            header("Location: /login"); exit;
        }
        $roles = $this->roleModel->all();
        $this->view('auth/register', ['roles'=>$roles]);
    }
}