<?php
session_start();
include "../config/db.php";

if ($_SESSION["role"] !== "admin") {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    mysqli_query(
        $conn,
        "INSERT INTO users (name,email,password) VALUES ('$name','$email','$password')"
    );

    header("Location: view.php");
}
?>

<?php include "../includes/header.php"; ?>

<div class="container">
<form method="post">
    <h2>Add User</h2>
    <input name="name" required>
    <input name="email" required>
    <input name="password" required>
    <button>Add</button>
</form>
</div>

<?php include "../includes/footer.php"; ?>
