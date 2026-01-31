<?php
include '../includes/middleware.php';
requireRole('admin');

include '../includes/header.php';
?>
<div class="container admin-box">

    <h2>Admin Dashboard</h2>

    <ul class="menu">
        <li><a href="add_student.php">Add Student</a></li>
        <li><a href="view_students.php">View Students</a></li>
        <li><a href="edit_student.php">Edit Student</a></li>
        <li><a href="delete_student.php">Delete Student</a></li>
        <li><a href="../auth/logout.php">Logout</a></li>
    </ul>

</div>

<?php include '../includes/footer.php'; ?>
