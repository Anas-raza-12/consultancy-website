<?php
// Database configuration
require '../admin/include/db_conn.php';

// Function to handle file uploads with restrictions
function uploadFile($fileInputName, $folder, $allowedExtensions, $maxSize) {
    if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES[$fileInputName]['tmp_name'];
        $fileName = $_FILES[$fileInputName]['name'];
        $fileSize = $_FILES[$fileInputName]['size'];
        $fileType = $_FILES[$fileInputName]['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Validate file extension
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "<script>alert('Invalid file type for $fileInputName. Allowed types: " . implode(", ", $allowedExtensions) . "');window.location.href='jobform.html';</script>";
            return null;
        }

        // Validate file size
        if ($fileSize > $maxSize) {
            echo "<script>alert('File size for $fileInputName exceeds the limit. Max size: " . ($maxSize / 1024) . " KB');window.location.href='jobform.html';</script>";
            return null;
        }

        // Generate a new file name and move the file
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $uploadFileDir = '../admin/uploads/' . $folder . '/';
        $dest_path = $uploadFileDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            return $newFileName;
        } else {
            echo "<script>alert('There was an error uploading the file.');window.location.href='jobform.html';</script>";
            return null;
        }
    } else {
        echo "<script>alert('No file uploaded or upload error for $fileInputName.');window.location.href='jobform.html';</script>";
        return null;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data and validate required fields
    $first_name = isset($_POST['first_name']) ? mysqli_real_escape_string($conn, $_POST['first_name']) : null;
    $last_name = isset($_POST['last_name']) ? mysqli_real_escape_string($conn, $_POST['last_name']) : null;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : null;
    $phone = isset($_POST['phone']) ? mysqli_real_escape_string($conn, $_POST['phone']) : null;
    $age = isset($_POST['age']) ? mysqli_real_escape_string($conn, $_POST['age']) : null;
    $gender = isset($_POST['gender']) ? mysqli_real_escape_string($conn, $_POST['gender']) : null;
    $location = isset($_POST['location']) ? mysqli_real_escape_string($conn, $_POST['location']) : null;
    $expected_salary = isset($_POST['expected_salary']) ? mysqli_real_escape_string($conn, $_POST['expected_salary']) : null;
    $current_salary = isset($_POST['current_salary']) ? mysqli_real_escape_string($conn, $_POST['current_salary']) : null;
    $skills = isset($_POST['skills']) ? mysqli_real_escape_string($conn, $_POST['skills']) : null;
    $education = isset($_POST['education']) ? mysqli_real_escape_string($conn, $_POST['education']) : null;
    $experience = isset($_POST['experience']) ? mysqli_real_escape_string($conn, $_POST['experience']) : null;

    // Optional fields
    $cover_letter = isset($_POST['cover_letter']) ? mysqli_real_escape_string($conn, $_POST['cover_letter']) : null;
    $certification = isset($_POST['certification']) ? mysqli_real_escape_string($conn, $_POST['certification']) : null;
    $language = isset($_POST['language']) ? mysqli_real_escape_string($conn, $_POST['language']) : null;
    $social_link = isset($_POST['social_link']) ? mysqli_real_escape_string($conn, $_POST['social_link']) : null;
    $linkedin = isset($_POST['linkedin']) ? mysqli_real_escape_string($conn, $_POST['linkedin']) : null;

    // Validate required fields
    if (!$first_name || !$last_name || !$email || !$phone || !$age || !$gender || !$location || !$expected_salary || !$current_salary || !$skills || !$education || !$experience) {
        echo "<script>alert('Please fill out all required fields.');window.location.href='jobform.html'</script>";
        exit();
    }

    // Handle file uploads with restrictions
    $image = uploadFile('image', 'candi_image', ['jpg', 'jpeg', 'png'], 500 * 1024); // 500KB
    $identity_card = uploadFile('identity_card', 'identity_card', ['jpg', 'jpeg', 'png'], 500 * 1024); // 500KB
    $cv = uploadFile('cv', 'cv', ['pdf'], 2 * 1024 * 1024); // 2MB

    if (!$image || !$identity_card || !$cv) {
        exit();
    }

    // Insert data into database
    $query = "INSERT INTO job_form_data (
                first_name, last_name, email, phone, age, gender, cover_letter, location,
                expected_salary, current_salary, skills, education, certification, language,
                experience, candi_image, identity_card, cv, socialLink, linkedIn
              ) VALUES (
                '$first_name', '$last_name', '$email', '$phone', $age, '$gender', '$cover_letter',
                '$location', '$expected_salary', '$current_salary', '$skills', '$education',
                '$certification', '$language', '$experience', '$image', '$identity_card', '$cv', '$social_link', '$linkedin'
              )";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Your form submitted successfully.');window.location.href='jobform.html'</script>";
    } else {
        echo '<script>alert("Error: ' . htmlspecialchars(mysqli_error($conn), ENT_QUOTES, 'UTF-8') . '");window.location.href="jobform.html"</script>';
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
