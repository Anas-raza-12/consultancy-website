<?php
require('include/db_conn.php');

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Sanitize input
        $id = mysqli_real_escape_string($conn, $id);

        // Prepare SQL query to delete the record
        $delete_sql = "DELETE FROM promotion_emails WHERE id = '$id'";

        if (mysqli_query($conn, $delete_sql)) {
            // Success message and redirect
            echo "<script>alert('Email successfully deleted!'); window.location.href = 'pro_emails.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href = 'pro_emails.php';</script>";
        }

        // Close the connection
        mysqli_close($conn);
    } else {
        echo "<script>alert('No ID provided.'); window.location.href = 'pro_emails.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request method.'); window.location.href = 'pro_emails.php';</script>";
}
