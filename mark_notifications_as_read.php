// mark_notifications_as_read.php
<?php
include 'connection.php';

$ids = $_POST['ids'];
$ids_string = implode(",", $ids);

$sql = "UPDATE notification SET is_read = TRUE WHERE id IN ($ids_string)";
if ($conn->query($sql) === TRUE) {
    echo "Notifications marked as read.";
} else {
    echo "Error updating notifications: " . $conn->error;
}

$conn->close();
?>
