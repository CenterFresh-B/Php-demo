<?php
include '../includes/middleware.php';
requireRole('student');
include '../includes/header.php';
?>
<div class="container">
    <div class="formdi">
        <h2>Student Dashboard</h2>

        <ul class="menu">
            <li><a href="view_profile.php">View My Profile</a></li>
            <li><a href="../auth/logout.php">Logout</a></li>
        </ul>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
