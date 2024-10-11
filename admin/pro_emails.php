<?php
require('include/db_conn.php');

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

// Fetch recent promotion emails
$emails_sql = "SELECT id, email, submitted_date FROM promotion_emails ORDER BY submitted_date DESC";
$emails_result = $conn->query($emails_sql);

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
                            Promotion Emails
                        </h1>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header mt-3 d-flex justify-content-between">
                                    <h5 class="card-title">Promotion Emails List</h5>
                                </div>
                                <div class="card-body">
                                    <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Email</th>
                                                <th>Submitted Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($emails_result->num_rows > 0) {
                                                $s_no = 1;
                                                while ($row = $emails_result->fetch_assoc()) {
                                                    $formatted_date = (new DateTime($row['submitted_date']))->format('d-m-Y');
                                                    echo "<tr>";
                                                    echo "<td>" . $s_no++ . ".</td>";
                                                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($formatted_date) . "</td>";
                                                    echo "<td class='table-action'>
                                                        <form action='delete_email.php' method='post' style='display:inline;'>
                                                            <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                                                            <button type='submit' class='btn btn-link p-0'>
                                                                <i class='fas fa-trash-alt text-danger'></i>
                                                            </button>
                                                        </form>
                                                    </td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='4'>No recent promotion emails found</td></tr>";
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
