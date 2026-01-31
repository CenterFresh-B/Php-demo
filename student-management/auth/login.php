<?php
include '../db.php';
include '../includes/middleware.php';
include '../includes/header.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users 
            WHERE username='$username' 
            AND password='$password' 
            LIMIT 1";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'role' => $user['role']
        ];

        if ($user['role'] === 'admin') {
            header("Location: ../admin/dashboard.php");
        } else {
            header("Location: ../student/dashboard.php");
        }
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>
<div class="container">
    <div>

        <h2>Login</h2>

        <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
        <?php endif; ?>
        
        <div class="di-center">

            <form method="POST">
                <input type="text" placeholder="Username" name="username" required>
                <input type="password" placeholder="Password" name="password" required>
                <button type="submit">Login</button><br>
                <p>New student? <a href="register.php">Register here</a></p>
            </form>

        </div>

    </div>
</div>

<?php include '../includes/footer.php'; ?>
