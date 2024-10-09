<?php
require('include/db_conn.php');

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

// Today's data
$today_job_seekers_sql = "SELECT COUNT(*) as count FROM job_form_details WHERE DATE(applied_date) = CURDATE()";
$result = $conn->query($today_job_seekers_sql);
$today_job_seekers = $result->fetch_assoc()['count'];

// Current data
$applied_job_seekers_sql = "SELECT COUNT(*) as count FROM job_form_details WHERE status = 'applied'";
$result = $conn->query($applied_job_seekers_sql);
$current_applied_job_seekers = $result->fetch_assoc()['count'];

$total_job_seekers_sql = "SELECT COUNT(*) as count FROM job_form_details";
$result = $conn->query($total_job_seekers_sql);
$current_total_job_seekers = $result->fetch_assoc()['count'];

// Previous data (e.g., from a week ago)
$previous_applied_job_seekers_sql = "SELECT COUNT(*) as count FROM job_form_details WHERE status = 'applied' AND applied_date < NOW() - INTERVAL 1 WEEK";
$result = $conn->query($previous_applied_job_seekers_sql);
$previous_applied_job_seekers = $result->fetch_assoc()['count'];

$previous_total_job_seekers_sql = "SELECT COUNT(*) as count FROM job_form_details WHERE applied_date < NOW() - INTERVAL 1 WEEK";
$result = $conn->query($previous_total_job_seekers_sql);
$previous_total_job_seekers = $result->fetch_assoc()['count'];

// Avoid division by zero
$previous_applied_job_seekers = $previous_applied_job_seekers ?: 1; // Set to 1 if zero
$previous_total_job_seekers = $previous_total_job_seekers ?: 1; // Set to 1 if zero

// Calculate percentage changes
$applied_job_seekers_percent_change = (($current_applied_job_seekers - $previous_applied_job_seekers) / $previous_applied_job_seekers) * 100;
$total_job_seekers_percent_change = (($current_total_job_seekers - $previous_total_job_seekers) / $previous_total_job_seekers) * 100;

// Format the percentage changes
$applied_job_seekers_percent_change = number_format($applied_job_seekers_percent_change, 2);
$total_job_seekers_percent_change = number_format($total_job_seekers_percent_change, 2);

// Fetch monthly application counts
$applicants_sql = "
    SELECT MONTH(applied_date) as month, COUNT(*) as count 
    FROM job_form_details 
    WHERE YEAR(applied_date) = YEAR(CURDATE())
    GROUP BY MONTH(applied_date)
    ORDER BY MONTH(applied_date)
";
$applicants_result = $conn->query($applicants_sql);

$applicants_data = [];
for ($i = 1; $i <= 12; $i++) {
    $applicants_data[$i] = 0;  // Initialize each month with 0 applicants
}

while($row = $applicants_result->fetch_assoc()) {
    $applicants_data[intval($row['month'])] = intval($row['count']);
}

// Fetch monthly applicants data for this year and last year
$applicants_sql = "
    SELECT
        MONTH(applied_date) as month,
        SUM(CASE WHEN YEAR(applied_date) = YEAR(CURDATE()) THEN 1 ELSE 0 END) AS this_year,
        SUM(CASE WHEN YEAR(applied_date) = YEAR(CURDATE()) - 1 THEN 1 ELSE 0 END) AS last_year
    FROM job_form_details
    GROUP BY MONTH(applied_date)
    ORDER BY MONTH(applied_date)
";
$applicants_result = $conn->query($applicants_sql);

$this_year_data = [];
$last_year_data = [];

for ($i = 1; $i <= 12; $i++) {
    $this_year_data[$i] = 0;  // Initialize each month with 0 applicants
    $last_year_data[$i] = 0;  // Initialize each month with 0 applicants
}

while($row = $applicants_result->fetch_assoc()) {
    $this_year_data[intval($row['month'])] = intval($row['this_year']);
    $last_year_data[intval($row['month'])] = intval($row['last_year']);
}

// Fetch recent 10 applicants
$applicants_sql = "SELECT id, name, email, applied_date FROM job_form_details ORDER BY applied_date DESC LIMIT 10";
$applicants_result = $conn->query($applicants_sql);

// Close the connection
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
		
		<?php include ('include/sidebar.php'); ?>

		<div class="main">

			<!-- Top-navbar included Here -->
				
			<?php include ('include/top-navbar.php'); ?>

			<main class="content">
				<div class="container-fluid">

					<div class="header">
						<h1 class="header-title">
						Welcome, Admin!
						</h1>
					</div>

					<div class="row">
						<!-- Today's Job Seekers -->
						<div class="col-md-6 col-lg-4 col-xl">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-3">
											<h5 class="card-title">Today's Job Seekers</h5>
										</div>
										<div class="col-auto">
											<div class="avatar">
												<div class="avatar-title rounded-circle bg-primary-dark">
													<i class="align-middle" data-feather="users"></i>
												</div>
											</div>
										</div>
									</div>
									<h1 class="display-1 mt-3 mb-3"><?php echo $today_job_seekers; ?></h1>
									<div class="mb-0">
										<span class="text-success"> <i class="mdi mdi-arrow-up-bold"></i> Recent applications</span>
									</div>
								</div>
							</div>
						</div>

						<!-- Applied Job Seekers -->
						<div class="col-md-6 col-lg-4 col-xl">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-3">
											<h5 class="card-title">Applied Job Seekers</h5>
										</div>
										<div class="col-auto">
											<div class="avatar">
												<div class="avatar-title rounded-circle bg-primary-dark">
													<i class="align-middle" data-feather="users"></i>
												</div>
											</div>
										</div>
									</div>
									<h1 class="display-1 mt-3 mb-3"><?php echo $current_applied_job_seekers; ?></h1>
									<div class="mb-0">
										<span class="text-<?php echo $applied_job_seekers_percent_change >= 0 ? 'success' : 'danger'; ?>">
											<i class="mdi mdi-arrow-<?php echo $applied_job_seekers_percent_change >= 0 ? 'up' : 'down'; ?>-bold"></i>
											<?php echo $applied_job_seekers_percent_change; ?>%
										</span>
										Change in applications
									</div>
								</div>
							</div>
						</div>

						<!-- Total Job Seekers -->
						<div class="col-md-6 col-lg-4 col-xl">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-3">
											<h5 class="card-title">Total Job Seekers</h5>
										</div>
										<div class="col-auto">
											<div class="avatar">
												<div class="avatar-title rounded-circle bg-primary-dark">
													<i class="align-middle" data-feather="users"></i>
												</div>
											</div>
										</div>
									</div>
									<h1 class="display-2 mt-3 mb-3"><?php echo $current_total_job_seekers; ?></h1>
									<div class="mb-0">
										<span class="text-<?php echo $total_job_seekers_percent_change >= 0 ? 'success' : 'danger'; ?>">
											<i class="mdi mdi-arrow-<?php echo $total_job_seekers_percent_change >= 0 ? 'up' : 'down'; ?>-bold"></i>
											<?php echo $total_job_seekers_percent_change; ?>%
										</span>
										Change in total job seekers
									</div>
								</div>
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-12 col-md-6 col-xxl-12 d-flex">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<h5 class="card-title mb-0">Applicants Applied</h5>
								</div>
								<div class="card-body py-3">
									<div class="chart chart-md">
										<canvas id="chartjs-dashboard-line"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-lg-8 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
									<h5 class="card-title mb-0">Recent Applicants</h5>
								</div>
								<table id="datatables-dashboard-products" class="table table-striped my-0">
									<thead>
										<tr>
											<th>S.No</th>
											<th>Name</th>
											<th class="d-none d-xl-table-cell">Email</th>
											<th class="d-none d-xl-table-cell">Applied Date</th>
											<th class="d-none d-xl-table-cell">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if ($applicants_result->num_rows > 0) {
											$s_no = 1;
											while($row = $applicants_result->fetch_assoc()) {
												$formatted_date = (new DateTime($row['applied_date']))->format('d-m-Y');
												echo "<tr>";
												echo "<td>" . $s_no++ . ".</td>";
												echo "<td>" . htmlspecialchars($row['name']) . "</td>";
												echo "<td class='d-none d-xl-table-cell'>" . htmlspecialchars($row['email']) . "</td>";
												echo "<td class='d-none d-xl-table-cell'>" . htmlspecialchars($formatted_date) . "</td>";
												echo "<td class='table-action'><a href='job_seeker_details.php?id=" . htmlspecialchars($row['id']) . "'><i class='align-middle fas fa-fw fa-eye'></i></a></td>";
												echo "</tr>";
											}
										} else {
											echo "<tr><td colspan='5'>No recent applicants found</td></tr>";
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="col-12 col-lg-4 d-flex">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<h5 class="card-title mb-0">Applied Applicants</h5>
								</div>
								<div class="card-body d-flex w-100">
									<div class="align-self-center chart chart-lg">
										<canvas id="chartjs-dashboard-bar-alt"></canvas>
									</div>
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