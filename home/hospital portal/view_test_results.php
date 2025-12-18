<?php
session_start();
include('db.php');

// Ensure the user is logged in as a patient
if ($_SESSION['role'] != 'patient') {
    header("Location: login.php");
    exit();
}

// Get the logged-in patient's ID from the session
$patient_id = $_SESSION['id'];

// Fetch the test results and treatments for the logged-in patient
$sql = "SELECT * FROM TestResults WHERE patient_id = '$patient_id'";
$results = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Test Results and Treatments</title>
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

        .no-results {
            text-align: center;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }

        /* Back to Dashboard Button */
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
    </style>
</head>
<body>

<div class="container">
    <!-- Back to Dashboard Button -->
    <a onclick="goBack()" >Go Back</a>
            <script>
    function goBack() {
        window.history.back();
    }
</script>

    <h2>Your Test Results and Treatments</h2>

    <?php if ($results->num_rows > 0): ?>
        <table>
            <tr>
                <th>Test Name</th>
                <th>Test Value</th>
                <th>Treatment</th>
                <th>Date</th>
            </tr>
            <?php while ($row = $results->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['test_name']; ?></td>
                    <td><?php echo $row['test_value']; ?></td>
                    <td><?php echo $row['treatment_type']; ?></td>
                    <td><?php echo $row['test_date']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <div class="no-results">
            <p>No test results available at the moment.</p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
