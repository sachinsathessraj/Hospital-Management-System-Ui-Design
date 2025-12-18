<?php
include 'db.php'; 
$query = "SELECT * FROM announcements ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>News and Updates</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        
        .header {
            position: relative;
            width: 100%;
            height: 300px; 
            overflow: hidden;
        }
        .header img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        .header-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color:; 
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="img1.png" alt="Hospital Header Image">
        <div class="header-overlay">
        </div>
    </div>
    
    <div class="news-container">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="news-item">
            <h2><?php echo htmlspecialchars($row['title']); ?></h2>
            <p><?php echo htmlspecialchars($row['content']); ?></p>
            <small>Category: <?php echo htmlspecialchars($row['category']); ?> | Date: <?php echo htmlspecialchars($row['created_at']); ?></small>
        </div>
        <?php } ?>
    </div>
</body>
</html>
