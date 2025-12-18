<?php
$messages = file("chat_log.txt", FILE_IGNORE_NEW_LINES);
$messages = array_slice($messages, -10); // Get last 10 messages
echo json_encode($messages);
?>