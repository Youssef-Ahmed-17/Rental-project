<?php
class DashboardController extends Controller {

    public function __construct() {
        session_start();
        if(!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 2) {
            header('Location: /login');
            exit;
        }
    }

    public function index() {
        $this->view('dashboard/index', ['name'=>$_SESSION['name']]);
    }
}