<?php
// Database connection
$servername = "localhost"; // Replace with your database server name
$username = "root";        // Replace with your database username
$password = "";            // Replace with your database password
$dbname = "hospital_db";    // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$patient_name = isset($_POST['patient_name']) ? $_POST['patient_name'] : 'Anonymous';
$rating = $_POST['rating'];
$comments = $_POST['comments'];

// SQL query to insert data into the feedback table
$sql = "INSERT INTO patient_feedback (patient_name, rating, comments)
        VALUES ('$patient_name', '$rating', '$comments')";

if ($conn->query($sql) === TRUE) {
    echo "Thank you for your feedback!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
