<?php
session_start();
include('db.php');


if ($_SESSION['role'] != 'staff') {
    header("Location: login.php");
    exit();
}


$sql = "SELECT BedBookings.booking_date, Users.username AS patient_name, BedsAvailability.ward_name 
        FROM BedBookings 
        JOIN Users ON BedBookings.patient_id = Users.id 
        JOIN BedsAvailability ON BedBookings.bed_id = BedsAvailability.bed_id";
$result = $conn->query($sql);
?>

<h2>Booked Beds</h2>
<table border="1">
    <tr>
        <th>Patient Name</th>
        <th>Ward Name</th>
        <th>Booking Date</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['patient_name']}</td>
                    <td>{$row['ward_name']}</td>
                    <td>{$row['booking_date']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No booked beds found</td></tr>";
    }
    ?>
</table>
