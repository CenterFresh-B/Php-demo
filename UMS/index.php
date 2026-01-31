<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: auth/login.php");
    exit();
}
?>

<?php include "includes/headerview.php"; ?>

<div class="container">
<h2>Dashboard</h2>

<a href="users/view.php">Manage Users</a><br><br>
<a href="auth/logout.php">Logout</a>
</div>

<?php include "includes/footer.php"; ?>
