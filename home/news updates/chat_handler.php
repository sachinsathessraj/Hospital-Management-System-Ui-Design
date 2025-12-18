<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST['message'];
    $file = fopen("chat_log.txt", "a");
    fwrite($file, date("[Y-m-d H:i:s] ") . $message . "\n");
    fclose($file);
    echo htmlspecialchars($message);
}
?>

