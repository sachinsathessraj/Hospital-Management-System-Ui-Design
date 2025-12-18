<?php
// register_handler.php

// Start session
session_start();

// Include database configuration
require_once 'config.php';

// Function to sanitize input
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $username = sanitize_input($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role_id = intval($_POST['role_id']);
    $first_name = sanitize_input($_POST['first_name']);
    $last_name = sanitize_input($_POST['last_name']);
    $email = sanitize_input($_POST['email']);
    $phone = sanitize_input($_POST['phone']);
    $address = sanitize_input($_POST['address']);

    // Validate password
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: register.php");
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    try {
        // Prepare SQL statement
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role_id, first_name, last_name, email, phone, address) VALUES (:username, :password, :role_id, :first_name, :last_name, :email, :phone, :address)");

        // Bind parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':role_id', $role_id);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);

        // Execute the statement
        $stmt->execute();

        $_SESSION['success'] = "Registration successful. Please login.";
        header("Location: login.php");
        exit();

    } catch (PDOException $e) {
        // Handle duplicate entries or other errors
        if ($e->getCode() == 23000) { // Integrity constraint violation
            $_SESSION['error'] = "Username or Email already exists.";
        } else {
            $_SESSION['error'] = "An error occurred: " . $e->getMessage();
        }
        header("Location: register.php");
        exit();
    }
} else {
    header("Location: register.php");
    exit();
}
?>
