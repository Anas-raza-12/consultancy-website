<?php
// Database configuration
require '../admin/include/db_conn.php';

// Function to handle file uploads with restrictions
function uploadFile($fileInputName, $folder, $allowedExtensions, $maxSize) {
    if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES[$fileInputName]['tmp_name'];
        $fileName = $_FILES[$fileInputName]['name'];
        $fileSize = $_FILES[$fileInputName]['size'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Validate file extension
        if (!in_array($fileExtension, $allowedExtensions)) {
            return ['error' => "Invalid file type for $fileInputName. Allowed types: " . implode(", ", $allowedExtensions)];
        }

        // Validate file size
        if ($fileSize > $maxSize) {
            return ['error' => "File size for $fileInputName exceeds the limit. Max size: " . ($maxSize / 1024) . " KB"];
        }

        // Generate a new file name and move the file
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $uploadFileDir = '../admin/uploads/' . $folder . '/';
        $dest_path = $uploadFileDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            return ['success' => $newFileName];
        } else {
            return ['error' => 'There was an error moving the file.'];
        }
    } else {
        return ['error' => 'No file uploaded or upload error for ' . $fileInputName];
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $country = 'PK';
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $expected_salary = mysqli_real_escape_string($conn, $_POST['expected_salary']);
    $current_salary = mysqli_real_escape_string($conn, $_POST['current_salary']);
    $skills = mysqli_real_escape_string($conn, $_POST['skills']);
    $education = mysqli_real_escape_string($conn, $_POST['education']);
    $experience = mysqli_real_escape_string($conn, $_POST['experience']);
    $certification = isset($_POST['certification']) ? mysqli_real_escape_string($conn, $_POST['certification']) : null;
    $social_link = isset($_POST['social_link']) ? mysqli_real_escape_string($conn, $_POST['social_link']) : null;

    // Validate required fields
    if (empty($first_name) || empty($email) || empty($phone) || empty($age) || empty($gender) || empty($location) || empty($expected_salary) || empty($current_salary) || empty($skills) || empty($education) || empty($experience)) {
        echo "<script>alert('Please fill out all required fields.');window.location.href='pakistani-form.html'</script>";
        exit();
    }

    // Handle file uploads
    $image = uploadFile('image', 'candi_image', ['jpg', 'jpeg', 'png'], 500 * 1024);
    $identity_card = uploadFile('identity_card', 'identity_card', ['jpg', 'jpeg', 'png'], 500 * 1024);
    $cv = uploadFile('cv', 'cv', ['pdf'], 2 * 1024 * 1024);

    // Check for upload errors
    if (isset($image['error']) || isset($identity_card['error']) || isset($cv['error'])) {
        $errorMessage = $image['error'] ?? $identity_card['error'] ?? $cv['error'];
        echo "<script>alert('$errorMessage');window.location.href='pakistani-form.html';</script>";
        exit();
    }

    // Prepare the query using procedural method
    $query = "INSERT INTO job_form_data 
              (first_name, email, phone, age, gender, country, location, expected_salary, current_salary, skills, education, certification, experience, candi_image, identity_card, cv, socialLink) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Initialize a prepared statement
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, 'sssisssiissssssss', $first_name, $email, $phone, $age, $gender, $country, $location, $expected_salary, $current_salary, $skills, $education, $certification, $experience, $image['success'], $identity_card['success'], $cv['success'], $social_link);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Your form submitted successfully.');window.location.href='pakistani-form.html';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_stmt_error($stmt) . "');window.location.href='pakistani-form.html';</script>";
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
