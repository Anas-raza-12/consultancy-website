<?php
// Get the current file name
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav id="sidebar" class="sidebar">
    <a class='sidebar-brand' href='dashboard.php'>
        <svg>
            <use xlink:href="#ion-ios-pulse-strong"></use>
        </svg>
        Consultancy
    </a>
    <div class="sidebar-content">
        <div class="sidebar-user">
            <img src="img/avatars/avatar-6.png" class="img-fluid rounded-circle mb-2" alt="Linda Miller" />
            <div class="fw-bold">Admin</div>
        </div>

        <ul class="sidebar-nav">
            <li class="sidebar-header">Main</li>

            <!-- Dashboard link -->
            <li class="sidebar-item <?= ($current_page == 'dashboard.php') ? 'active' : '' ?>">
                <a href="dashboard.php" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-home"></i> 
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <!-- Job Seekers link -->
            <li class="sidebar-item <?= ($current_page == 'job_seekers.php') ? 'active' : '' ?>">
                <a class='sidebar-link' href='job_seekers.php'>
                    <i class="align-middle me-2 fas fa-fw fa-user"></i> 
                    <span class="align-middle">Jobs Seekers</span>
                </a>
            </li>

            <!-- Email Promotions link -->
            <li class="sidebar-item <?= ($current_page == 'pro_emails.php') ? 'active' : '' ?>">
                <a class='sidebar-link' href='pro_emails.php'>
                    <i class="align-middle me-2 fas fa-fw fa-envelope"></i> 
                    <span class="align-middle">Promotion Emails</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
