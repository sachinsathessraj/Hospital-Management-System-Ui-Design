<?php
include 'db_connection.php';

// Handle adding news
if (isset($_POST['add_news'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    $sql = "INSERT INTO news (title, content) VALUES ('$title', '$content')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle deleting news
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM news WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Fetch news
$result = $conn->query("SELECT * FROM news ORDER BY date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="news.css">
    <title>Staff News Management</title>
</head>
<body>
    <h1>Manage News</h1>

    <form method="POST" action="">
        <input type="text" name="title" placeholder="News Title" required>
        <textarea name="content" placeholder="News Content" required></textarea>
        <button type="submit" name="add_news">Add News</button>
    </form>

    <h2>Existing News</h2>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div>
            <h3><?php echo $row['title']; ?></h3>
            <p><?php echo $row['content']; ?></p>
            <p><em><?php echo $row['date']; ?></em></p>
            <a href="news_management.php?delete=<?php echo $row['id']; ?>">Delete</a>
        </div>
    <?php endwhile; ?>

</body>
</html>
