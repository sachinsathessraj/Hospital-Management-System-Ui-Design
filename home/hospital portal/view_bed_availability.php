<?php
session_start();
include('db.php');

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$patient_id = $_SESSION['id'];

if (isset($_GET['book_bed_id'])) {
    $bed_id = $_GET['book_bed_id'];

    $check_sql = "SELECT available_beds FROM BedsAvailability WHERE bed_id = '$bed_id'";
    $check_result = $conn->query($check_sql);
    $bed_info = $check_result->fetch_assoc();

    if ($bed_info['available_beds'] > 0) {
   
        $book_sql = "INSERT INTO BedBookings (patient_id, bed_id) VALUES ('$patient_id', '$bed_id')";
        if ($conn->query($book_sql) === TRUE) {
            
            $update_bed_sql = "UPDATE BedsAvailability SET available_beds = available_beds - 1 WHERE bed_id = '$bed_id'";
            $conn->query($update_bed_sql);
            $message = "Bed booked successfully!";
        } else {
            $error = "Error booking bed: " . $conn->error;
        }
    } else {
        $error = "Bed is no longer available.";
    }
}


$sql = "SELECT bed_id, ward_name, room_number, total_beds, available_beds 
        FROM BedsAvailability 
        WHERE available_beds > 0";
$result = $conn->query($sql);


$booked_sql = "SELECT bb.booking_id, b.bed_id, b.ward_name, b.room_number, bb.booking_date 
               FROM BedBookings bb 
               JOIN BedsAvailability b ON bb.bed_id = b.bed_id 
               WHERE bb.patient_id = '$patient_id'";
$booked_result = $conn->query($booked_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bed Availability</title>
    <style>
        body {
            background-color: #f0f4f8;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #2c3e50;
            text-align: center;
            font-size: 28px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }

        .book-button {
            background-color: #2ecc71;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .book-button:hover {
            background-color: #27ae60;
        }

        .delete-button {
            background-color: #e74c3c;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .delete-button:hover {
            background-color: #c0392b;
        }

        .success-message, .error-message {
            text-align: center;
            margin: 20px 0;
            padding: 10px;
            border-radius: 4px;
        }

        .success-message {
            background-color: #2ecc71;
            color: white;
        }

        .error-message {
            background-color: #e74c3c;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>View Bed Availability</h2>

    <a class="delete-button"onclick="goBack()" >Go Back</a>
            <script>
    function goBack() {
        window.history.back();
    }
</script>
    <?php if (isset($message)): ?>
        <div class="success-message"><?php echo $message; ?></div>
    <?php elseif (isset($error)): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>

   
    <h3>Available Beds</h3>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Bed ID</th>
                <th>Ward Name</th>
                <th>Room Number</th>
                <th>Total Beds</th>
                <th>Available Beds</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['bed_id']; ?></td>
                    <td><?php echo $row['ward_name']; ?></td>
                    <td><?php echo $row['room_number']; ?></td>
                    <td><?php echo $row['total_beds']; ?></td>
                    <td><?php echo $row['available_beds']; ?></td>
                    <td>
                        <a href="view_bed_availability.php?book_bed_id=<?php echo $row['bed_id']; ?>" class="book-button">Book</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No available beds.</p>
    <?php endif; ?>

    <h3>Your Booked Beds</h3>
    <?php if ($booked_result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Booking ID</th>
                <th>Bed ID</th>
                <th>Ward Name</th>
                <th>Room Number</th>
                <th>Booking Date</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $booked_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['booking_id']; ?></td>
                    <td><?php echo $row['bed_id']; ?></td>
                    <td><?php echo $row['ward_name']; ?></td>
                    <td><?php echo $row['room_number']; ?></td>
                    <td><?php echo $row['booking_date']; ?></td>
                    <td>
                        <a href="view_bed_availability.php?delete_booking_id=<?php echo $row['booking_id']; ?>" class="delete-button" onclick="return confirm('Are you sure you want to cancel this booking?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>You have no booked beds.</p>
    <?php endif; ?>
</div>

</body>
</html>
