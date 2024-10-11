<?php
    require '../admin/include/db_conn.php';

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];

        // Validate email format
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Ensure the email is properly sanitized
            $email = mysqli_real_escape_string($conn, $email);

            // Check if the email already exists
            $check_sql = "SELECT * FROM promotion_emails WHERE email = '$email'";
            $check_result = mysqli_query($conn, $check_sql);

            if (mysqli_num_rows($check_result) > 0) {
                // Email already exists
                echo "<script>alert('This email is already registered. Please use a different email address.'); window.history.back();</script>";
            } else {
                // Prepare SQL query to insert new email
                $insert_sql = "INSERT INTO promotion_emails (email) VALUES ('$email')";

                // Execute the query
                if (mysqli_query($conn, $insert_sql)) {
                    // Success message with history back to the previous page
                    echo "<script>alert('Email successfully submitted!'); window.history.back();</script>";
                } else {
                    echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.history.back();</script>";
                }
            }
        } else {
            // Email is not valid
            echo "<script>alert('Invalid email format. Please enter a valid email address.'); window.history.back();</script>";
        }

        // Close the connection
        mysqli_close($conn);
    }
?>
