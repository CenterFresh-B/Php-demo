<?php
include '../includes/middleware.php';
requireRole('admin');
include '../db.php';

// 1. Check ID
if (!isset($_GET['id'])) {
    header("Location: view_students.php");
    exit;
}

$id = (int) $_GET['id'];

// 2. Delete student
$delete = mysqli_query($conn, "DELETE FROM students WHERE id = $id");

// 3. Redirect back
header("Location: view_students.php?msg=deleted");
exit;
