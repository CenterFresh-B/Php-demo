<?php
session_start();

include "../config/db.php";
include "../includes/flash.php";

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../dashboard/index.php");
    exit();
}

if (!isset($_GET["id"])) {
    header("Location: view.php");
    exit();
}

$id = (int) $_GET["id"];

$result = mysqli_query($conn, "SELECT name, email, role FROM users WHERE id = $id");

if (mysqli_num_rows($result) !== 1) {
    header("Location: view.php");
    exit();
}

$user = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name  = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $role  = $_POST["role"] === "admin" ? "admin" : "user";

    $sql = "UPDATE users
            SET name='$name', email='$email', role='$role'
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {

        setFlash("success", "User updated successfully.");

        header("Location: view.php");
        exit();
    } else {

        setFlash("error", "Failed to update user.");
    }
}
?>

<?php include "../includes/header.php"; ?>

<form class="card" method="post">
    <h2>Edit User</h2>

    <div class="field">
        <label>Name</label>
        <input type="text"
               name="name"
               value="<?= htmlspecialchars($user["name"]) ?>"
               required>
    </div>

    <div class="field">
        <label>Email</label>
        <input type="email"
               name="email"
               value="<?= htmlspecialchars($user["email"]) ?>"
               required>
    </div>

    <div class="field">
        <label>Role</label>
        <select name="role" class="select">
            <option value="user" <?= $user["role"] === "user" ? "selected" : "" ?>>
                User
            </option>
            <option value="admin" <?= $user["role"] === "admin" ? "selected" : "" ?>>
                Admin
            </option>
        </select>
    </div>

    <button class="btn" type="submit">Update</button>

    <div class="center mt-20">
        <a href="view.php">Cancel</a>
    </div>
</form>

<?php include "../includes/footer.php"; ?>
