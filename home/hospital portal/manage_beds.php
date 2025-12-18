<?php
session_start();
include('db.php');

// Ensure the user is logged in as staff
if ($_SESSION['role'] != 'staff') {
    header("Location: login.php");
    exit();
}

// Handle room and bed deletion
if (isset($_GET['delete_id'])) {
    $bed_id = $_GET['delete_id'];

    // Delete the selected bed/room from the BedsAvailability table
    $delete_sql = "DELETE FROM BedsAvailability WHERE bed_id = '$bed_id'";
    if ($conn->query($delete_sql) === TRUE) {
        $message = "Room/bed and associated bookings deleted successfully!";
    } else {
        $error = "Error deleting room/bed: " . $conn->error;
    }
}

// Handle adding new bed/room
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_bed'])) {
    $ward_name = $_POST['ward_name'];
    $room_number = $_POST['room_number'];
    $total_beds = $_POST['total_beds'];
    $available_beds = $_POST['available_beds'];

    // Insert new bed/room into the BedsAvailability table
    $insert_sql = "INSERT INTO BedsAvailability (ward_name, room_number, total_beds, available_beds) 
                   VALUES ('$ward_name', '$room_number', '$total_beds', '$available_beds')";
    if ($conn->query($insert_sql) === TRUE) {
        $message = "New room/beds added successfully!";
    } else {
        $error = "Error adding room/bed: " . $conn->error;
    }
}

// Fetch all beds/rooms from the BedsAvailability table
$sql = "SELECT * FROM BedsAvailability";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Beds Availability</title>
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

        .back-button {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #2980b9;
        }

        form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        form input[type="text"], form input[type="number"], form select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form button {
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        form button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Back to Dashboard Button -->
    <a href="staff_dashboard.php" class="back-button">← Back to Dashboard</a>

    <h2>Manage Beds Availability</h2>

    <?php if (isset($message)): ?>
        <div class="success-message"><?php echo $message; ?></div>
    <?php elseif (isset($error)): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>

    <!-- Add Bed/Room Form -->
    <form method="POST">
        <h3>Add New Room/Bed</h3>
        <label for="ward_name">Ward Name:</label>
        <input type="text" name="ward_name" required>

        <label for="room_number">Room Number:</label>
        <input type="text" name="room_number" required>

        <label for="total_beds">Total Beds:</label>
        <input type="number" name="total_beds" required>

        <label for="available_beds">Available Beds:</label>
        <input type="number" name="available_beds" required>

        <button type="submit" name="add_bed">Add Room/Bed</button>
    </form>

    <!-- Display Beds/Rooms -->
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
                        <a href="manage_beds.php?delete_id=<?php echo $row['bed_id']; ?>" class="delete-button" onclick="return confirm('Are you sure you want to delete this room/bed?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No beds/rooms available.</p>
    <?php endif; ?>
</div>

</body>
</html>
