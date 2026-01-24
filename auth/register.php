<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    mysqli_query(
        $conn,
        "INSERT INTO users (name, email, password) VALUES ('$name','$email','$password')"
    );

    header("Location: login.php");
    exit();
}
?>

<?php include "../includes/header.php"; ?>

<div class="container">
<form method="post">
    <h2>Register</h2>
    <input name="name" required placeholder="Name">
    <input name="email" required type="email" placeholder="Email">
    <input name="password" required type="password" placeholder="Password">
    <button>Register</button>
    <a href="login.php">Login</a>
</form>
</div>

<?php include "../includes/footer.php"; ?>
