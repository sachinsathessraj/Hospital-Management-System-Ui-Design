<?php
session_start();
if (!isset($_SESSION['staff'])) {
    header('Location: login.php');
    exit();
}

include 'db.php'; 
$query = "SELECT * FROM announcements ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin - Manage Announcements</title>
    <link rel="stylesheet" href="styles1.css">
</head>
<body>
    <h1>Manage Hospital Announcements</h1>
    <a href="add_news.php">Add New Announcement</a>
    
    <table>
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['category']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
                <a href="edit_news.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                <a href="delete_news.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <button class="back-button" onclick="goBack()" type="submit">Back</button>
    <script>
function goBack() {
    window.history.back();
}
</script>
</body>
</html>
