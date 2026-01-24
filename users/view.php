<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../index.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM users");
?>

<?php include "../includes/header.php"; ?>

<div class="container">
<h2>Users</h2>
<div class="rightbox"><a href="add.php">Add User</a></div>

<table>
<tr><th>ID</th><th>Name</th><th>Email</th><th>Action</th></tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
<td><?= $row["id"] ?></td>
<td><?= $row["name"] ?></td>
<td><?= $row["email"] ?></td>
<td>
<a href="delete.php?id=<?= $row["id"] ?>">Delete</a>
</td>
</tr>
<?php } ?>

</table>
<a href="test/UMS/auth/logout.php">Logout</a>
</div>

<?php include "../includes/footer.php"; ?>
