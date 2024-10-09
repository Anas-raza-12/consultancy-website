<?php
require('include/db_conn.php');

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM job_form_details WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$job_seeker = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!-- Header included Here -->
<?php include('include/header.php'); ?>

<body>
    <div class="main p-3" style="background-color: #f4f4f4;">
        <div class="container-fluid m-0 p-0">
            <div class="row mb-4">
                <div class="col-lg-6">
                    <h3 class="font-weight-bold">Job Seeker Profile</h3>
                    <div class="d-flex">
                        <p class="m-1">Dashboard</p>
                        <span class="m-1">/</span>
                        <p class="m-1">Job Seeker</p>
                        <span class="m-1">/</span>
                        <p class="m-1">Profile</p>
                    </div>
                </div>
                <div class="col-lg-6 d-flex justify-content-end align-items-end">
                    <button type="button" class="btn btn-light m-1 border">
                        <i class="fa-solid fa-lock"></i> &nbsp; Login Details
                    </button>
                    <button type="button" class="btn btn-primary m-1">
                        <i class="fa-solid fa-pen-to-square"></i> &nbsp; Edit Profile
                    </button>
                </div>
            </div>

            <div class="row">
                <!-- Basic Information -->
                <div class="col-lg-3">
                    <div class="card mb-3 p-3 bg-white rounded">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://placehold.co/72x72.png" alt="Job Seeker Image" class="rounded-circle me-3">
                            <div>
                                <h5><?php echo htmlspecialchars($job_seeker['name']); ?></h5>
                                <p>ID: <?php echo htmlspecialchars($job_seeker['id']); ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="p-2">
                            <h4>Basic Information</h4>
                            <div class="d-flex justify-content-between">
                                <h6>Gender</h6>
                                <p><?php echo htmlspecialchars($job_seeker['gender']); ?></p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6>Date of Birth</h6>
                                <p><?php echo (new DateTime($job_seeker['dob']))->format('d-M-Y'); ?></p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6>Religion</h6>
                                <p><?php echo htmlspecialchars($job_seeker['religion']); ?></p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6>Address</h6>
                                <p><?php echo htmlspecialchars($job_seeker['address']); ?></p>
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="button">Contact</button>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3 p-3 bg-white rounded">
                        <h5>Contact Information</h5>
                        <div class="my-2">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-phone"></i>
                                <div class="ms-3">
                                    <h6 class="m-0 p-0">Phone</h6>
                                    <p class="p-0 m-0"><?php echo htmlspecialchars($job_seeker['phone']); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="my-2">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-envelope"></i>
                                <div class="ms-3">
                                    <h6 class="m-0 p-0">Email</h6>
                                    <p class="p-0 m-0"><?php echo htmlspecialchars($job_seeker['email']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Professional Details -->
                <div class="col-lg-8">
                    <div class="card mb-3 p-3 bg-white rounded">
                        <h5>Professional Details</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Current Status:</strong> <?php echo htmlspecialchars($job_seeker['current_status']); ?></p>
                                <p class="mb-2"><strong>Job Type:</strong> <?php echo htmlspecialchars($job_seeker['job_type']); ?></p>
                                <p class="mb-2"><strong>Applied Position:</strong> <?php echo htmlspecialchars($job_seeker['apply_position']); ?></p>
                                <p class="mb-2"><strong>Applied Date:</strong> <?php echo (new DateTime($job_seeker['applied_date']))->format('d-m-Y'); ?></p>
                                <p class="mb-2"><strong>Status:</strong> <?php echo htmlspecialchars($job_seeker['status']); ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2"><strong>University:</strong> <?php echo htmlspecialchars($job_seeker['university']); ?></p>
                                <p class="mb-2"><strong>Degree:</strong> <?php echo htmlspecialchars($job_seeker['degree']); ?></p>
                                <p class="mb-2"><strong>Degree Start:</strong> <?php echo (new DateTime($job_seeker['deg_start']))->format('d-m-Y'); ?></p>
                                <p class="mb-2"><strong>Degree End:</strong> <?php echo (new DateTime($job_seeker['deg_end']))->format('d-m-Y'); ?></p>
                                <p class="mb-2"><strong>Degree Ongoing:</strong> <?php echo htmlspecialchars($job_seeker['deg_ongoing']); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3 p-3 bg-white rounded">
                        <h5>Work Experience</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Previous Work Title:</strong> <?php echo htmlspecialchars($job_seeker['pre_work_title']); ?></p>
                                <p class="mb-2"><strong>Company Name:</strong> <?php echo htmlspecialchars($job_seeker['company_name']); ?></p>
                                <p class="mb-2"><strong>Start Date:</strong> <?php echo (new DateTime($job_seeker['pre_work_sdate']))->format('d-m-Y'); ?></p>
                                <p class="mb-2"><strong>End Date:</strong> <?php echo (new DateTime($job_seeker['pre_work_edate']))->format('d-m-Y'); ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2"><strong>LinkedIn:</strong> <a href="<?php echo htmlspecialchars($job_seeker['linkedin']); ?>" target="_blank"><?php echo htmlspecialchars($job_seeker['linkedin']); ?></a></p>
                                <p class="mb-2"><strong>Twitter:</strong> <a href="<?php echo htmlspecialchars($job_seeker['twitter']); ?>" target="_blank"><?php echo htmlspecialchars($job_seeker['twitter']); ?></a></p>
                                <p class="mb-2"><strong>Facebook:</strong> <a href="<?php echo htmlspecialchars($job_seeker['facebook']); ?>" target="_blank"><?php echo htmlspecialchars($job_seeker['facebook']); ?></a></p>
                                <p class="mb-2"><strong>GitHub:</strong> <a href="<?php echo htmlspecialchars($job_seeker['github']); ?>" target="_blank"><?php echo htmlspecialchars($job_seeker['github']); ?></a></p>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3 p-3 bg-white rounded">
                        <h5>Attachments</h5>
                        <p class="mb-2"><strong>CV:</strong> <a href="<?php echo htmlspecialchars($job_seeker['cv']); ?>">Download</a></p>
                        <p class="mb-2"><strong>Cover Letter:</strong> <a href="<?php echo htmlspecialchars($job_seeker['cover_letter']); ?>">Download</a></p>
                        <p class="mb-2"><strong>Identity Card:</strong> <a href="<?php echo htmlspecialchars($job_seeker['identity_card']); ?>">Download</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer included Here -->
    <?php include('include/footer.php'); ?>
</body>
</html>
