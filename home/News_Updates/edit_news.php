<?php
session_start();
if (!isset($_SESSION['staff'])) {
    header('Location: login.php');
    exit();
}

include 'db.php'; // Database connection
$id = $_GET['id'];
$query = "SELECT * FROM announcements WHERE id = $id";
$result = mysqli_query($conn, $query);
$announcement = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];

    $query = "UPDATE announcements SET title='$title', content='$content', category='$category' WHERE id=$id";
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
    <title>Edit Announcement</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Edit Announcement</h2>
    <form method="POST">
        <input type="text" name="title" value="<?php echo $announcement['title']; ?>" required><br>
        <textarea name="content" required><?php echo $announcement['content']; ?></textarea><br>
        <select name="category" required>
            <option value="Announcements" <?php if($announcement['category'] == 'Announcements') echo 'selected'; ?>>Hospital Announcements</option>
            <option value="Health Tips" <?php if($announcement['category'] == 'Health Tips') echo 'selected'; ?>>Health Tips</option>
            <option value="Community Outreach" <?php if($announcement['category'] == 'Community Outreach') echo 'selected'; ?>>Community Outreach</option>
        </select><br>
        <button type="submit">Update Announcement</button>
    </form>
</body>
</html>
