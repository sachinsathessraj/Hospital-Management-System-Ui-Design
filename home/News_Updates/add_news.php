<?php
session_start();
if (!isset($_SESSION['staff'])) {
    header('Location: login.php');
    exit();
}

include 'db.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];

    $query = "INSERT INTO announcements (title, content, category) VALUES ('$title', '$content', '$category')";
    if (mysqli_query($conn, $query)) {
        header('Location: admin.php');
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Announcement</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Add New Announcement</h2>
    <form method="POST">
        <input type="text" name="title" placeholder="Title" required><br>
        <textarea name="content" placeholder="Content" required></textarea><br>
        <select name="category" required>
            <option value="Announcements">Hospital Announcements</option>
            <option value="Health Tips">Health Tips</option>
            <option value="Community Outreach">Community Outreach</option>
        </select><br>
        <button type="submit">Add Announcement</button>
    </form>
</body>
</html>
