<?php
include 'db_connection.php';

$sql = "SELECT * FROM news ORDER BY date DESC";
$result = $conn->query($sql);
$news_data = [];

while ($row = $result->fetch_assoc()) {
    $news_data[] = $row;
}

echo json_encode($news_data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="news.js"></script>
    <title>Document</title>
</head>
<body>
    
</body>
</html>