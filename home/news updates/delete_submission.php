<?php
session_start();

// Define the same credentials as in staff_view.php
define('USERNAME', 'staff');
define('PASSWORD', 'password123'); // Ensure this matches the password in staff_view.php

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: staff_view.php");
    exit();
}

// Check if the form was submitted with an ID
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $submission_id = intval($_POST['id']); // Sanitize input

    // Database connection parameters
    $servername = "localhost";
    $username_db = "root"; // Replace with your MySQL username
    $password_db = "";     // Replace with your MySQL password
    $dbname = "contact_form_db";

    // Create a new MySQLi connection
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Check for a successful connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the DELETE statement
    $stmt = $conn->prepare("DELETE FROM contact_submissions WHERE id = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the ID parameter
    $stmt->bind_param("i", $submission_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to the staff view page after deletion
        header("Location: staff_view.php");
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Invalid request
    header("Location: staff_view.php");
    exit();
}
?>
