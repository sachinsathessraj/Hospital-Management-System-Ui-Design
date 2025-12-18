<?php
session_start();
include('db.php');

// Ensure the user is logged in as staff
if ($_SESSION['role'] != 'staff') {
    header("Location: login.php");
    exit();
}

// Handle theatre deletion
if (isset($_GET['delete_id'])) {
    $theatre_id = $_GET['delete_id'];

    // Delete the selected theatre from the database
    $delete_sql = "DELETE FROM OperationTheatre WHERE theatre_id = '$theatre_id'";
    if ($conn->query($delete_sql) === TRUE) {
        $message = "Theatre deleted successfully!";
    } else {
        $error = "Error deleting theatre: " . $conn->error;
    }
}

// Handle operation theatre availability updates
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $theatre_name = $_POST['theatre_name'];
    $available = $_POST['available'];

    // Insert or update theatre availability
    $sql = "INSERT INTO OperationTheatre (theatre_name, available) VALUES ('$theatre_name', '$available')";
    
    if ($conn->query($sql) === TRUE) {
        $message = "Operation theatre added successfully!";
    } else {
        $error = "Error: " . $conn->error;
    }
}

// Fetch all operation theatres
$theatres_sql = "SELECT * FROM OperationTheatre";
$theatres = $conn->query($theatres_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Operation Theatre Availability</title>
    <style>
        /* General Page Styling */
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

        form {
            display: block;
            width: 100%;
            margin: 20px 0;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            font-size: 16px;
            color: #333;
        }

        input[type="text"], select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #2980b9;
        }

        table {
            width: 100%;
            margin: 20px 0;
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
    </style>
</head>
<body>

<div class="container">
    <a href="staff_dashboard.php" class="back-button">← Back to Dashboard</a>

    <h2>Manage Operation Theatre Availability</h2>

    <?php if (isset($message)): ?>
        <div class="success-message"><?php echo $message; ?></div>
    <?php elseif (isset($error)): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>

    <!-- Operation Theatre Form -->
    <form method="POST">
        <label for="theatre_name">Theatre Name:</label>
        <input type="text" name="theatre_name" required><br>

        <label for="available">Available:</label>
        <select name="available">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select><br>

        <button type="submit">Add/Update Theatre</button>
    </form>

    <!-- Display All Theatres -->
    <h3>Current Operation Theatres</h3>
    <table>
        <tr>
            <th>Theatre Name</th>
            <th>Available</th>
            <th>Action</th>
        </tr>
        <?php
        if ($theatres->num_rows > 0) {
            while ($row = $theatres->fetch_assoc()) {
                $availability = $row['available'] ? 'Yes' : 'No';
                echo "<tr>
                        <td>{$row['theatre_name']}</td>
                        <td>{$availability}</td>
                        <td><a href='manage_operation_theatre.php?delete_id={$row['theatre_id']}' class='delete-button'>Delete</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No operation theatres available</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
