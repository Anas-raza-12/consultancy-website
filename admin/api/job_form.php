<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require '../include/db_conn.php'; // Make sure to include your database connection file

$response = [
    'success' => false,
    'message' => 'An unexpected error occurred.'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cvPath = null;
    
    // Handle file upload
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
        $cvName = basename($_FILES['cv']['name']);
        $cvPath = 'uploads/' . $cvName;
        
        // Create the uploads directory if it does not exist
        if (!file_exists('uploads')) {
            mkdir('uploads', 0755, true);
        }
        
        // Move the uploaded file
        if (move_uploaded_file($_FILES['cv']['tmp_name'], $cvPath)) {
            $cvPath = $cvPath; // Store the path of the uploaded file
        } else {
            $response['message'] = 'Failed to upload CV';
            echo json_encode($response);
            exit;
        }
    }

    // Retrieve and sanitize form data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $age = $conn->real_escape_string($_POST['age']);
    $religion = $conn->real_escape_string($_POST['religion']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $coverLetter = $conn->real_escape_string($_POST['coverLetter']);
    $identityCard = $conn->real_escape_string($_POST['identityCard']);
    $currentStatus = $conn->real_escape_string($_POST['currentStatus']);
    $jobType = $conn->real_escape_string($_POST['jobType']);
    $address = $conn->real_escape_string($_POST['address']);
    $country = $conn->real_escape_string($_POST['country']);
    $city = $conn->real_escape_string($_POST['city']);
    $university = $conn->real_escape_string($_POST['university']);
    $degree = $conn->real_escape_string($_POST['degree']);
    $degStart = $conn->real_escape_string($_POST['degStart']);
    $degEnd = $conn->real_escape_string($_POST['degEnd']);
    $degOngoing = isset($_POST['degOngoing']) ? 1 : 0;
    $linkedin = $conn->real_escape_string($_POST['linkedin']);
    $twitter = $conn->real_escape_string($_POST['twitter']);
    $facebook = $conn->real_escape_string($_POST['facebook']);
    $github = $conn->real_escape_string($_POST['github']);
    $preWorkTitle = $conn->real_escape_string($_POST['preWorkTitle']);
    $companyName = $conn->real_escape_string($_POST['companyName']);
    $preWorkSdate = $conn->real_escape_string($_POST['preWorkSdate']);
    $preWorkEdate = $conn->real_escape_string($_POST['preWorkEdate']);
    $applyPosition = $conn->real_escape_string($_POST['applyPosition']);

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO job_form_details (name, email, phone, age, religion, gender, dob, cv, cover_letter, identity_card, current_status, job_type, address, country, city, university, degree, deg_start, deg_end, deg_ongoing, linkedin, twitter, facebook, github, pre_work_title, company_name, pre_work_sdate, pre_work_edate, apply_position)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssssssssssssssssssssssssss',
        $name, $email, $phone, $age, $religion, $gender, $dob, $cvPath, $coverLetter, $identityCard, $currentStatus, $jobType, $address, $country, $city, $university, $degree, $degStart, $degEnd, $degOngoing, $linkedin, $twitter, $facebook, $github, $preWorkTitle, $companyName, $preWorkSdate, $preWorkEdate, $applyPosition
    );

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Form submitted successfully.';
    } else {
        $response['message'] = 'Failed to submit form.';
    }

    $stmt->close();
    $conn->close();
    echo json_encode($response);
    
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Fetch data
    $sql = "SELECT * FROM job_form_details";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode(['status' => 'success', 'data' => $data]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No data found.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
