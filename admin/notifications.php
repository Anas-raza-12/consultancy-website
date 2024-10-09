<?php
include 'db_connection.php'; // Include your DB connection

session_start();
$userId = $_SESSION['user_id'];

// Fetch notifications
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT * FROM job_notifications WHERE user_id = $userId AND is_read = FALSE ORDER BY created_at DESC";
    $result = mysqli_query($conn, $query);
    $notifications = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($notifications);
}

// Mark as read
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $notificationId = $_POST['id'];
    $query = "UPDATE job_notifications SET is_read = TRUE WHERE id = $notificationId AND user_id = $userId";
    mysqli_query($conn, $query);
}
?>
