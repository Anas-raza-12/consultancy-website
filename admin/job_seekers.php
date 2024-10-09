<?php
require('include/db_conn.php');

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

// Fetch recent 10 job seekers
$applicants_sql = "SELECT id, name, email, phone, age, applied_date FROM job_form_details ORDER BY applied_date DESC";
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
        <?php include('include/sidebar.php'); ?>

        <div class="main">

            <!-- Top-navbar included Here -->
            <?php include('include/top-navbar.php'); ?>

            <main class="content">
                <div class="container-fluid">

                    <div class="header">
                        <h1 class="header-title">
                            Applied Job Seekers
                        </h1>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header mt-3 d-flex justify-content-between">
                                    <h5 class="card-title">Applied Job Seekers List</h5>
                                    <!-- Export to Excel Button -->
                                    <a href="export.php" class="btn btn-primary">Export to Excel</a>
                                </div>
                                <div class="card-body">
                                    <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Age</th>
                                                <th>Applied Date</th>
                                                <th>Action</th>
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
                                                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['age']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($formatted_date) . "</td>";
                                                    echo "<td class='table-action'><a href='job_seeker_details.php?id=" . htmlspecialchars($row['id']) . "'><i class='align-middle fas fa-fw fa-eye'></i></a></td>";

                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='7'>No recent applicants found</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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
