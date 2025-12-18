<?php
// login_handler.php

session_start();
require_once 'config.php';

// Function to sanitize input
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitize_input($_POST['username']);
    $password = $_POST['password'];
    $role_id = intval($_POST['role_id']);

    // Validate inputs
    if (empty($username) || empty($password) || empty($role_id)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: login.php");
        exit();
    }

    try {
        // Prepare SQL statement
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND role_id = :role_id");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':role_id', $role_id);
        $stmt->execute();

        $user = $stmt->fetch();

        if ($user) {
            // Verify password
            if (password_verify($password, $user['password'])) {
                // Password is correct, set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role_id'] = $user['role_id'];

                // Redirect based on role
                switch ($user['role_id']) {
                    case 1:
                        header("Location: admin_dashboard.php");
                        break;
                    case 2:
                        header("Location: user_dashboard.php");
                        break;
                    case 3:
                        header("Location: operational_staff_dashboard.php");
                        break;
                    default:
                        header("Location: login.php");
                }
                exit();
            } else {
                $_SESSION['error'] = "Invalid username or password.";
                header("Location: login.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Invalid username or password.";
            header("Location: login.php");
            exit();
        }

    } catch (PDOException $e) {
        $_SESSION['error'] = "An error occurred: " . $e->getMessage();
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>
