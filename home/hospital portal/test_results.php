<?php
session_start();
include('db.php');

// Ensure the user is logged in as staff
if ($_SESSION['role'] != 'staff') {
    header("Location: login.php");
    exit();
}

// Handle test result submission and treatment selection
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id']; // The selected patient's ID
    $test_name = $_POST['test_name'];
    $test_value = $_POST['test_value']; // This will be Low, Normal, or High
    $treatment_type = $_POST['treatment_type'];
    $test_date = date('Y-m-d'); // Get the current date

    // Insert the test result and treatment type into the database
    $sql = "INSERT INTO TestResults (patient_id, test_name, test_value, treatment_type, test_date) 
            VALUES ('$patient_id', '$test_name', '$test_value', '$treatment_type', '$test_date')";

    if ($conn->query($sql) === TRUE) {
        $message = "Test result and treatment added successfully!";
    } else {
        $error = "Error: " . $conn->error;
    }
}

// Fetch patients for selection
$patients_sql = "SELECT * FROM Users WHERE role='patient'";
$patients = $conn->query($patients_sql);

// Fetch treatments and test results for the selected patient
$treatments_sql = "SELECT * FROM TestResults WHERE patient_id = '" . (isset($_POST['patient_id']) ? $_POST['patient_id'] : 0) . "'";
$treatments = $conn->query($treatments_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Test Results and Treatments</title>
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

        select {
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
            margin-top: 15px;
            width: 100%;
        }

        button:hover {
            background-color: #2980b9;
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

        .no-treatments {
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
    <a href="staff_dashboard.php" class="back-button">← Back to Dashboard</a>

    <h2>Manage Test Results and Treatments</h2>

    <?php if (isset($message)): ?>
        <div class="success-message"><?php echo $message; ?></div>
    <?php elseif (isset($error)): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>

    <!-- Test Result and Treatment Form -->
    <form method="POST">
        <label for="patient_id">Select Patient:</label>
        <select name="patient_id" required>
            <?php while ($patient = $patients->fetch_assoc()) { ?>
                <option value="<?php echo $patient['id']; ?>"><?php echo $patient['username']; ?></option>
            <?php } ?>
        </select><br>

        <label for="test_name">Select Test:</label>
        <select name="test_name" required>
            <option value="Complete Blood Count (CBC)">Complete Blood Count (CBC)</option>
            <option value="CBC with Absolute Counts">CBC with Absolute Counts</option>
            <option value="CBC with ESR">CBC with ESR</option>
            <option value="Coagulation Profile">Coagulation Profile</option>
            <option value="Liver Function Test (LFT)">Liver Function Test (LFT)</option>
            <option value="Kidney Function Test (KFT)">Kidney Function Test (KFT)</option>
            <option value="Lipid Profile">Lipid Profile</option>
            <option value="Electrolytes Panel">Electrolytes Panel</option>
            <option value="Thyroid Function Test (TFT)">Thyroid Function Test (TFT)</option>
            <option value="Thyroid Antibodies Test">Thyroid Antibodies Test</option>
            <option value="Arthritis Profile">Arthritis Profile</option>
            <option value="Protein Fraction">Protein Fraction</option>
            <option value="Torch Profile">Torch Profile</option>
            <option value="Comprehensive Metabolic Panel (CMP)">Comprehensive Metabolic Panel (CMP)</option>
            <option value="Dengue Fever Panel">Dengue Fever Panel</option>
        </select><br>

        <label for="test_value">Select Test Value:</label>
        <select name="test_value" required>
            <option value="Low">Low</option>
            <option value="Normal">Normal</option>
            <option value="High">High</option>
        </select><br>

        <label for="treatment_type">Select Treatment Type:</label>
        <select name="treatment_type" required>
            <option value="Surgery">Surgery</option>
            <option value="Cardiology">Cardiology</option>
            <option value="Neurological Conditions">Neurological Conditions</option>
            <option value="Orthopedics">Orthopedics</option>
        </select><br>

        <button type="submit">Add Test Result and Treatment</button>
    </form>

    <!-- Display Patient Treatment List -->
    <h3>Patient Treatment List</h3>
    <?php if ($treatments->num_rows > 0): ?>
        <table>
            <tr>
                <th>Test Name</th>
                <th>Test Value</th>
                <th>Treatment Type</th>
                <th>Date</th>
            </tr>
            <?php while ($treatment = $treatments->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $treatment['test_name']; ?></td>
                    <td><?php echo $treatment['test_value']; ?></td>
                    <td><?php echo $treatment['treatment_type']; ?></td>
                    <td><?php echo $treatment['test_date']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <div class="no-treatments">
            <p>No treatments currently available for this patient.</p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>