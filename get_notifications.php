<?php
include 'connection.php';

session_start();
$user_id = $_SESSION['user_id']; // Ensure the user is logged in

$sql = "SELECT * FROM notification WHERE user_id = '$user_id' AND is_read = FALSE ORDER BY created_at DESC";
$result = $conn->query($sql);

$notifications = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }
}

echo json_encode($notifications);


?>
