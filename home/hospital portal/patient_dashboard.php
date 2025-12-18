<?php
session_start();
include('db.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
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

        .dashboard-menu {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .dashboard-item {
            background-color: #e74c3c;
            color: white;
            padding: 15px 30px;
            margin: 10px;
            text-align: center;
            border-radius: 8px;
            text-decoration: none;
            font-size: 18px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .dashboard-item:hover {
            background-color: #c0392b;
            cursor: pointer;
        }

        footer {
            text-align: center;
            padding: 10px 0;
            margin-top: 50px;
            background-color: #2c3e50;
            color: white;
        }

        .dashboard-item img {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }

      
        .back-button {
            display: inline-block;
            background-color: #e74c3c;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #c0392b;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    
    
    <a class="back-button" onclick="goBack()" >Go Back</a>
            <script>
    function goBack() {
        window.history.back();
    }
</script>

    <h2>Patient Dashboard</h2>

    <div class="dashboard-menu">
        <a href="view_test_results.php" class="dashboard-item">
            <img src="https://img.icons8.com/color/48/000000/test-tube.png" alt="View Test Results Icon">
            View Test Results
        </a>
        <a href="view_bed_availability.php" class="dashboard-item">
            <img src="https://img.icons8.com/color/48/000000/bed.png" alt="View Bed Availability Icon">
            View & Book Bed
        </a>
        <a href="view_operation_theatre.php" class="dashboard-item">
            <img src="https://img.icons8.com/external-flat-wichaiwi/64/000000/external-surgery-healthcare-flat-wichaiwi.png" alt="View Operation Theatre Icon">
            View & Book Operation Theatre
        </a>
    </div>
</div>

<footer>
    &copy; 2024 Hospital Management System - Patient Dashboard
</footer>

</body>
</html>
