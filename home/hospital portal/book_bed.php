<?php
session_start();
include('db.php');

// Ensure the user is logged in as a patient
if ($_SESSION['role'] != 'patient') {
    header("Location: login.php");
    exit();
}

// Handle the bed booking
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bed_id = $_POST['bed_id'];
    $patient_id = $_SESSION['id']; // The ID of the logged-in patient

    // Check if the selected bed is still available
    $check_sql = "SELECT * FROM BedsAvailability WHERE bed_id = '$bed_id' AND available_beds > 0";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        // Update the available beds by decreasing by 1
        $sql = "UPDATE BedsAvailability SET available_beds = available_beds - 1 WHERE bed_id = '$bed_id'";
        if ($conn->query($sql) === TRUE) {
            // Insert the booking into the BedBookings table
            $insert_booking_sql = "INSERT INTO BedBookings (patient_id, bed_id, booking_date)
                                   VALUES ('$patient_id', '$bed_id', NOW())";
            if ($conn->query($insert_booking_sql) === TRUE) {
                echo "Bed booked successfully!";
            } else {
                echo "Error booking the bed: " . $conn->error;
            }
        } else {
            echo "Error updating the available beds: " . $conn->error;
        }
    } else {
        echo "Sorry, no beds are available for this ward.";
    }
}
?>
