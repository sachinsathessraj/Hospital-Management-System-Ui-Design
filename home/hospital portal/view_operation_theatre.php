<?php
session_start();
include('db.php');

if ($_SESSION['role'] != 'patient') {
    header("Location: login.php");
    exit();
}


$sql = "SELECT * FROM OperationTheatre WHERE available = 1";
$result = $conn->query($sql);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $theatre_id = $_POST['theatre_id'];
    $patient_id = $_SESSION['id']; 

  
    $check_sql = "SELECT * FROM OperationTheatre WHERE theatre_id = '$theatre_id' AND available = 1";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        
        $update_sql = "UPDATE OperationTheatre SET available = 0 WHERE theatre_id = '$theatre_id'";
        $conn->query($update_sql);

        
        $insert_sql = "INSERT INTO OperationTheatreBookings (patient_id, theatre_id, booking_date) 
                       VALUES ('$patient_id', '$theatre_id', NOW())";
        if ($conn->query($insert_sql) === TRUE) {
            $message = "Operation Theatre booked successfully!";
        } else {
            $error = "Error booking operation theatre: " . $conn->error;
        }
    } else {
        $error = "Sorry, the operation theatre is no longer available.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View & Book Operation Theatre</title>
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
            cursor: pointer;
        }

        /* Book Button */
        .book-button {
            background-color: #e74c3c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .book-button:hover {
            background-color: #c0392b;
        }

        .no-available-theatres {
            text-align: center;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="container">
 
    <a href="patient_dashboard.php" class="back-button">← Back to Dashboard</a>
    <a class="back-button" onclick="goBack()" >Go Back</a>
            <script>
    function goBack() {
        window.history.back();
    }
</script>
    <h2>View & Book Operation Theatre</h2>

    <?php if (isset($message)): ?>
        <div class="success-message"><?php echo $message; ?></div>
    <?php elseif (isset($error)): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($result->num_rows > 0): ?>
        <form method="POST">
            <table>
                <tr>
                    <th>Select</th>
                    <th>Theatre Name</th>
                    <th>Status</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><input type="radio" name="theatre_id" value="<?php echo $row['theatre_id']; ?>" required></td>
                        <td><?php echo $row['theatre_name']; ?></td>
                        <td><?php echo $row['available'] ? 'Available' : 'Not Available'; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
            <button type="submit" class="book-button">Book Theatre</button>
        </form>
    <?php else: ?>
        <div class="no-available-theatres">
            <p>No available operation theatres at the moment.</p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
