<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth/login.php");
    exit();
}
?>

<h2>Dashboard</h2>

<?php if ($_SESSION["role"] === "admin") { ?>
    <a href="../users/view.php">Manage Users</a>
<?php } ?>

<a href="../auth/logout.php">Logout</a>
