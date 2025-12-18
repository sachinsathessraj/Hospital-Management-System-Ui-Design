<?php
session_start();
if (!isset($_SESSION['staff'])) {
    header('Location: login.php');
    exit();
}

include 'db.php'; // Database connection
$id = $_GET['id'];
$query = "DELETE FROM announcements WHERE id = $id";

if (mysqli_query($conn, $query)) {
    header('Location: admin.php');
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
