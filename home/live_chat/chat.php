<?php
header('Content-Type: application/json');

$host = 'localhost'; // Update if different
$db = 'live_chat_db';
$user = 'root';      // Update with your DB user
$password = '';      // Update with your DB password

// Create connection
$conn = new mysqli($host, $user, $password, $db);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['status' => 'Connection failed: ' . $conn->connect_error]));
}

// Handle GET request to fetch messages
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = $conn->query("SELECT * FROM messages ORDER BY created_at ASC");
    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
    echo json_encode($messages);
}

// Handle POST request to send a message
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Determine sender type based on a hidden input or separate API endpoints
    $sender_type = isset($_POST['sender_type']) ? $_POST['sender_type'] : 'user';
    $sender_name = isset($_POST['sender_name']) ? $_POST['sender_name'] : 'Anonymous';
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    // Validate inputs
    if (empty($message)) {
        echo json_encode(['status' => 'Message cannot be empty']);
        exit;
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO messages (sender_type, sender_name, message) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $sender_type, $sender_name, $message);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'Message sent successfully']);
    } else {
        echo json_encode(['status' => 'Error sending message']);
    }
}

$conn->close();
?>
