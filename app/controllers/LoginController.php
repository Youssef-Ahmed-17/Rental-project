<?php
require_once __DIR__ . "/../models/User.php";

class LoginController {

    public function loginUser() {

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $user = new User();
            $data = $user->login($_POST["email"], $_POST["password"]);

            if ($data) {
                // حفظ الجلسة
                session_start();
                $_SESSION["user"] = $data;

                // تحويل حسب الـ role
                if ($data["role"] === "tenant") {
                    header("Location: tenantWall.php");
                } 
                else if ($data["role"] === "landlord") {
                    header("Location: landlordDashboard.php");
                }
                else if ($data["role"] === "admin") {
                    header("Location: adminDashboard.php");
                }

                exit;
            }

            return ["status" => false, "msg" => "Wrong email or password."];
        }
    }
}
