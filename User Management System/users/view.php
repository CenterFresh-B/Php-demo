<?php
session_start();
include "../config/db.php";
include "../includes/flash.php";

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../dashboard/index.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>

<?php include "../includes/header.php"; ?>

<table>
<tr>
    <th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Action</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?= $row["id"] ?></td>
    <td><?= htmlspecialchars($row["name"]) ?></td>
    <td><?= htmlspecialchars($row["email"]) ?></td>
    <td><?= $row["role"] ?></td>
    <td>
        <a href="edit.php?id=<?= $row["id"] ?>">Edit</a>
    </td>
</tr>
<?php } ?>

</table>

<?php include "../includes/footer.php"; ?>
