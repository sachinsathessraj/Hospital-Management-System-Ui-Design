<?php
session_start();

// Define simple credentials (Change these in a real application)
define('USERNAME', 'staff');
define('PASSWORD', '1234'); // Use a strong password

// Handle login submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    if ($input_username === USERNAME && $input_password === PASSWORD) {
        $_SESSION['loggedin'] = true;
    } else {
        $login_error = "Invalid username or password.";
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: staff_view.php");
    exit();
}

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Display the login form
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Staff Login</title>
        <link rel="stylesheet" href="contactform.css">
    </head>

    <style>body {
    font-family: Arial, sans-serif;
    background-color: #0a7acb;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

form {
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 300px;
    text-align: center;
}

h2 {
    margin-bottom: 20px;
    color: #333;
}

input[type="text"], input[type="password"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin: 10px 0;
}

button:hover {
    background-color: #0056b3;
}

.back-button {
    background-color: #6c757d;
}

.back-button:hover {
    background-color: #5a6268;
}

p {
    font-size: 14px;
}
</style>
    <body>
        <form method="POST" action="staff_view.php">
            <h2>Staff Login</h2>
            <?php
            if (isset($login_error)) {
                echo "<p style='color:red;'>$login_error</p>";
            }
            ?>
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="login">Login</button>
            <button class="back-button" onclick="goBack()" type="submit">Back</button>
        <script>
function goBack() {
    window.history.back();
}
</script>
        </form>
    </body>
    </html>
    <?php
    exit();
}

// If logged in, display the submissions
// Database connection parameters
$servername = "localhost";
$username_db = "root"; // Replace with your MySQL username
$password_db = "";     // Replace with your MySQL password
$dbname = "contact_form_db";

// Create a new MySQLi connection
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Check for a successful connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve all submissions
$sql = "SELECT * FROM contact_submissions ORDER BY submission_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff - Manage Submissions</title>
    <link rel="stylesheet" href="contactform.css">
</head>
<body>
    <h1>Contact Form Submissions</h1>
    <p><a href="staff_view.php?logout=true">Logout</a></p>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Department</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Date Submitted</th>
            <th>Action</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row["id"]) . "</td>
                        <td>" . htmlspecialchars($row["department"]) . "</td>
                        <td>" . htmlspecialchars($row["name"]) . "</td>
                        <td>" . htmlspecialchars($row["email"]) . "</td>
                        <td>" . nl2br(htmlspecialchars($row["message"])) . "</td>
                        <td>" . htmlspecialchars($row["submission_date"]) . "</td>
                        <td>
                            <form method='POST' action='delete_submission.php' onsubmit='return confirm(\"Are you sure you want to delete this submission?\");'>
                                <input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>
                                <button type='submit'>Delete</button>
                            </form>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No submissions found.</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>

    </table>
</body>
</html>
