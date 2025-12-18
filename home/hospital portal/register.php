<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the username already exists
    $check_username_sql = "SELECT * FROM Users WHERE username='$username'";
    $result = $conn->query($check_username_sql);

    if ($result->num_rows > 0) {
        echo "Username already exists. Please choose another.";
    } else {
        
        $sql = "INSERT INTO Users (username, email, password, role) 
                VALUES ('$username', '$email', '$hashed_password', '$role')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful. You can now <a href='login.php'>login</a>.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Hospital Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role" required>
                <option value="" disabled selected>Select Role</option>
                <option value="patient">Patient</option>
                <option value="staff">Staff</option>
            </select>
            <button type="submit">Register</button>
            <button class="back-button" onclick="goBack()" type="submit">Back</button>

        </form>
        <script>
function goBack() {
    window.history.back();
}
</script>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
