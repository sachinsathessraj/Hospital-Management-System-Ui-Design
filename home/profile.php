<?php
// profile.php

session_start();
require_once 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user data
$user_id = $_SESSION['user_id'];

try {
    $stmt = $pdo->prepare("SELECT username, first_name, last_name, email, phone, address FROM users WHERE id = :id");
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch();

    if (!$user) {
        $_SESSION['error'] = "User not found.";
        header("Location: login.php");
        exit();
    }

} catch (PDOException $e) {
    $_SESSION['error'] = "An error occurred: " . $e->getMessage();
    header("Location: login.php");
    exit();
}

// Fetch upcoming appointments
try {
    $stmt = $pdo->prepare("SELECT * FROM appointments WHERE user_id = :user_id AND appointment_date >= NOW() AND status != 'Cancelled' ORDER BY appointment_date ASC");
    $stmt->execute(['user_id' => $user_id]);
    $upcoming_appointments = $stmt->fetchAll();
} catch (PDOException $e) {
    $upcoming_appointments = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Profile</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <header>
        <h1>My Profile</h1>
        <nav>
            
            <a onclick="goBack()" >Go Back</a>
            <script>
    function goBack() {
        window.history.back();
    }
</script>
<a href="logout.php">Logout</a>
        </nav>
    </header>
    <div class="profile-container">
        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="error">'.$_SESSION['error'].'</div>';
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
            echo '<div class="success">'.$_SESSION['success'].'</div>';
            unset($_SESSION['success']);
        }
        ?>
        <form action="update_profile.php" method="POST">
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" disabled>

            <label>First Name:</label>
            <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>

            <label>Last Name:</label>
            <input type="text" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label>Phone:</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>">

            <label>Address:</label>
            <textarea name="address"><?php echo htmlspecialchars($user['address']); ?></textarea>

            <button type="submit">Update Profile</button>
        </form>

       
           
        </div>
    </div>
</body>
</html>
