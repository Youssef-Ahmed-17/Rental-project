<?php
// app/controllers/RegisterController.php

session_start();
require_once __DIR__ . '/../models/User.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Get and sanitize input data
    $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $national_id = filter_input(INPUT_POST, 'national_id', FILTER_SANITIZE_STRING);
    
    // Validate required fields
    if (empty($role) || empty($name) || empty($email) || empty($password) || 
        empty($city) || empty($phone) || empty($national_id)) {
        header("Location: ../views/register.php?error=All fields are required");
        exit();
    }
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../views/register.php?error=Invalid email format");
        exit();
    }
    
    // Validate password length
    if (strlen($password) < 6) {
        header("Location: ../views/register.php?error=Password must be at least 6 characters");
        exit();
    }
    
    // Validate role
    if ($role !== 'tenant' && $role !== 'landlord') {
        header("Location: ../views/register.php?error=Invalid role selected");
        exit();
    }
    
    // Create User model instance
    $userModel = new User();
    
    // Check if email already exists
    if ($userModel->emailExists($email)) {
        header("Location: ../views/register.php?error=Email already registered");
        exit();
    }
    
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // Register the user
    $userId = $userModel->register($name, $email, $hashedPassword, $role, $city, $phone, $national_id);
    
    if ($userId) {
        // Registration successful
        $_SESSION['user_id'] = $userId;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_role'] = $role;
        $_SESSION['user_email'] = $email;
        
        // Redirect based on role
        if ($role === 'landlord') {
            header("Location: ../views/landlord_dashboard.php");
        } else {
            header("Location: ../views/tenant_dashboard.php");
        }
        exit();
    } else {
        header("Location: ../views/register.php?error=Registration failed. Please try again");
        exit();
    }
    
} else {
    // If not POST request, redirect to register page
    header("Location: ../views/register.php");
    exit();
}
?>