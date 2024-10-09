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
									<h3 class="font-weight-bold"><?php echo htmlspecialchars($job_seeker['name']); ?></h3>
									<p>ID: <?php echo htmlspecialchars($job_seeker['id']); ?></p>
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
									<div class="row">
										<div class="col-md-6">
											<p class="card-text" style="margin-bottom: 1rem;">
												<strong>Current Status:</strong> <?php echo ucfirst(htmlspecialchars($job_seeker['current_status'])); ?>
											</p>
											<p class="card-text" style="margin-bottom: 1rem;">
												<strong>Job Type:</strong> <?php echo ucfirst(htmlspecialchars($job_seeker['job_type'])); ?>
											</p>
											<p class="card-text" style="margin-bottom: 1rem;">
												<strong>Applied Position:</strong> <?php echo ucfirst(htmlspecialchars($job_seeker['apply_position'])); ?>
											</p>
											<p class="card-text" style="margin-bottom: 1rem;">
												<strong>Applied Date:</strong> <?php echo (new DateTime($job_seeker['applied_date']))->format('d-m-Y'); ?>
											</p>
											<p class="card-text" style="margin-bottom: 1rem;">
												<strong>Status:</strong> <?php echo ucfirst(htmlspecialchars($job_seeker['status'])); ?>
											</p>
										</div>
										<div class="col-md-6">
											<p class="card-text" style="margin-bottom: 1rem;">
												<strong>University:</strong> <?php echo htmlspecialchars($job_seeker['university']); ?>
											</p>
											<p class="card-text" style="margin-bottom: 1rem;">
												<strong>Degree:</strong> <?php echo ucfirst(htmlspecialchars($job_seeker['degree'])); ?>
											</p>
											<p class="card-text" style="margin-bottom: 1rem;">
												<strong>Degree Start:</strong> <?php echo (new DateTime($job_seeker['deg_start']))->format('d-m-Y'); ?>
											</p>
											<p class="card-text" style="margin-bottom: 1rem;">
												<strong>Degree End:</strong> 
												<?php 
													if ($job_seeker['deg_ongoing'] == 1) {
														echo 'Ongoing';
													} else {
														echo (new DateTime($job_seeker['deg_end']))->format('d-m-Y');
													}
												?>
											</p>
											<p class="card-text" style="margin-bottom: 1rem;">
												<strong>Degree Ongoing:</strong> 
												<?php 
													echo ($job_seeker['deg_ongoing'] == 1) ? 'Yes' : 'No';
												?>
											</p>
										</div>
									</div>
								</div>
							</div>
							
							<div class="card mb-3">
								<div class="card-body">
									<h4>Work Experience</h4>
									<hr>
									<div class="row">
										<div class="col-md-6">
											<p class="card-text" style="margin-bottom: 1rem;">
												<strong>Previous Work Title:</strong> <?php echo ucfirst(htmlspecialchars($job_seeker['pre_work_title'])); ?>
											</p>
											<p class="card-text" style="margin-bottom: 1rem;">
												<strong>Company Name:</strong> <?php echo ucfirst(htmlspecialchars($job_seeker['company_name'])); ?>
											</p>
											<p class="card-text" style="margin-bottom: 1rem;">
												<strong>Start Date:</strong> <?php echo (new DateTime($job_seeker['pre_work_sdate']))->format('d-m-Y'); ?>
											</p>
											<p class="card-text" style="margin-bottom: 1rem;">
												<strong>End Date:</strong> <?php echo (new DateTime($job_seeker['pre_work_edate']))->format('d-m-Y'); ?>
											</p>
										</div>
										<div class="col-md-6">
											<p class="card-text" style="margin-bottom: 1rem;">
												<strong>LinkedIn:</strong> <a href="<?php echo htmlspecialchars($job_seeker['linkedin']); ?>"><?php echo htmlspecialchars($job_seeker['linkedin']); ?></a>
											</p>
											<p class="card-text" style="margin-bottom: 1rem;">
												<strong>Twitter:</strong> <a href="<?php echo htmlspecialchars($job_seeker['twitter']); ?>"><?php echo htmlspecialchars($job_seeker['twitter']); ?></a>
											</p>
											<p class="card-text" style="margin-bottom: 1rem;">
												<strong>Facebook:</strong> <a href="<?php echo htmlspecialchars($job_seeker['facebook']); ?>"><?php echo htmlspecialchars($job_seeker['facebook']); ?></a>
											</p>
											<p class="card-text" style="margin-bottom: 1rem;">
												<strong>GitHub:</strong> <a href="<?php echo htmlspecialchars($job_seeker['github']); ?>"><?php echo htmlspecialchars($job_seeker['github']); ?></a>
											</p>
										</div>
									</div>
								</div>
							</div>
							
							<div class="card mb-3">
								<div class="card-body">
									<h4>Attachments</h4>
									<hr>
									<p class="card-text" style="margin-bottom: 1rem;">
										<strong>CV:</strong> <a href="api/<?php echo htmlspecialchars($job_seeker['cv']); ?>">Download</a>
									</p>
									<p class="card-text" style="margin-bottom: 1rem;">
										<strong>Cover Letter:</strong> <?php echo nl2br(htmlspecialchars($job_seeker['cover_letter'])); ?>
									</p>
									<p class="card-text">
										<strong>Identity Card:</strong> <?php echo htmlspecialchars($job_seeker['identity_card']); ?>
									</p>
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