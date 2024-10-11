<?php
    require('include/db_conn.php');
    
    session_start();
    
    if (!isset($_SESSION['username'])) {
        header('Location: index.php');
        exit();
    }
    
    $id = $_GET['id'];
    $sql = "SELECT * FROM job_form_data WHERE id = ?";
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
    <div class="splash active">
        <div class="splash-icon"></div>
    </div>
    <div class="wrapper">
        <!-- Sidebar included Here -->
        <?php include('include/sidebar.php'); ?>
        <div class="main">
            <!-- Top-navbar included Here -->
            <?php include('include/top-navbar.php'); ?>
            <main class="content">
                <div class="container-fluid">
                    <div class="header">
                        <h1 class="header-title">Job Seeker Profile</h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card mb-3 p-3 bg-white rounded">
                                <div class="text-center mb-3">
                                    <img src="uploads/candi_image/<?php echo htmlspecialchars($job_seeker['candi_image']); ?>" alt="Profile Image" class="img-fluid rounded-circle" style="width: 100px;">
                                    <h3 class="font-weight-bold"><?php echo htmlspecialchars($job_seeker['first_name'] . ' ' . $job_seeker['last_name']); ?></h3>
                                    <p>ID: <?php echo htmlspecialchars($job_seeker['id']); ?></p>
                                </div>
                                <hr>
                                <div class="p-2">
                                    <h4>Basic Information</h4>
                                    <div class="d-flex justify-content-between">
                                        <h6>Gender</h6>
                                        <p><?php echo ucfirst(htmlspecialchars($job_seeker['gender'])); ?></p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6>Age</h6>
                                        <p><?php echo htmlspecialchars($job_seeker['age']); ?></p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6>Location</h6>
                                        <p><?php echo htmlspecialchars($job_seeker['location']); ?></p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6>Expected Salary</h6>
                                        <p><?php echo htmlspecialchars($job_seeker['expected_salary']); ?></p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6>Current Salary</h6>
                                        <p><?php echo htmlspecialchars($job_seeker['current_salary']); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3 p-3 bg-white rounded">
                                <h4>Contact Information</h4>
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

                        <div class="col-lg-8">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h4>Professional Details</h4>
                                    <hr>
                                    <p><strong>Skills:</strong> <?php echo nl2br(htmlspecialchars($job_seeker['skills'])); ?></p>
                                    <p><strong>Education:</strong> <?php echo nl2br(htmlspecialchars($job_seeker['education'])); ?></p>
                                    <p><strong>Certifications:</strong> <?php echo nl2br(htmlspecialchars($job_seeker['certification'])); ?></p>
                                    <p><strong>Languages:</strong> <?php echo nl2br(htmlspecialchars($job_seeker['language'])); ?></p>
                                </div>
                            </div>
                            
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h4>Social Links</h4>
                                    <hr>
                                    <p><strong>LinkedIn:</strong> <a href="<?php echo htmlspecialchars($job_seeker['linkedIn']); ?>"><?php echo htmlspecialchars($job_seeker['linkedIn']); ?></a></p>
                                    <p><strong>Other Social Links:</strong> <?php echo htmlspecialchars($job_seeker['socialLink']); ?></p>
                                </div>
                            </div>
                            
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h4>Attachments</h4>
                                    <hr>
                                    <p><strong>CV:</strong> <a href="uploads/cv/<?php echo htmlspecialchars($job_seeker['cv']); ?>">Download</a></p>
                                    <p><strong>Cover Letter:</strong> <?php echo nl2br(htmlspecialchars($job_seeker['cover_letter'])); ?></p>
                                    <p><strong>Identity Card:</strong> <a href="uploads/identity_card/<?php echo htmlspecialchars($job_seeker['identity_card']); ?>">Download</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!-- Footer included Here -->
            <?php include('include/footer.php'); ?>
        </div>
    </div>
    <!-- Footer Links included Here -->
    <?php include('include/footer_links.php'); ?>
</body>
</html>
