<?php
session_start();
include('db.php');

// Ensure the user is logged in as a patient
if ($_SESSION['role'] != 'patient') {
    header("Location: login.php");
    exit();
}

// Handle the booking
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $theatre_id = $_POST['theatre_id'];
    $patient_id = $_SESSION['id']; // The ID of the logged-in patient

    // Check if the selected theatre is still available
    $check_sql = "SELECT * FROM OperationTheatre WHERE theatre_id = '$theatre_id' AND available = 1";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        // Mark the theatre as booked (unavailable)
        $sql = "UPDATE OperationTheatre SET available = 0 WHERE theatre_id = '$theatre_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Operation theatre booked successfully!";
        } else {
            echo "Error booking the operation theatre: " . $conn->error;
        }
    } else {
        echo "Sorry, this theatre is no longer available.";
    }
}
?>
