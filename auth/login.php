<?php
session_start();
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["role"] = $user["role"];
            header("Location: ../index.php");
            exit();
        }
    }
}
?>

<?php include "../includes/header.php"; ?>

<div class="container">
<form method="post">
    <h2>Login</h2>
    <input name="email" type="email" required placeholder="Email">
    <input name="password" type="password" required placeholder="Password">
    <button>Login</button>
    <a href="register.php">Register</a>
</form>
</div>

<?php include "../includes/footer.php"; ?>
