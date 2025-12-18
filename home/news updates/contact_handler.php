<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = "";     // Replace with your MySQL password
$dbname = "contact_form_db";

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for a successful connection
if ($conn->connect_error) {
    // In production, consider logging this error instead of displaying it
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $department = trim($_POST['department']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Basic validation
    if (empty($department) || empty($name) || empty($email) || empty($message)) {
        echo "All fields are required.";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }

    // Prepare an SQL statement for insertion
    $stmt = $conn->prepare("INSERT INTO contact_submissions (department, name, email, message) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        // Handle errors appropriately in production
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters to the SQL statement
    $stmt->bind_param("ssss", $department, $name, $email, $message);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Message sent successfully!";
    } else {
        // Handle errors appropriately in production
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
