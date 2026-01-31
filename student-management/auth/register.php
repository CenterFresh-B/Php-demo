<?php
include '../db.php';
include '../includes/header.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roll     = mysqli_real_escape_string($conn, $_POST['roll_no']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    // 1. Check if student exists
    $studentCheck = mysqli_query(
        $conn,
        "SELECT id, user_id FROM students WHERE roll_no = '$roll'"
    );

    if (mysqli_num_rows($studentCheck) !== 1) {
        $error = "Invalid roll number.";
    } else {
        $student = mysqli_fetch_assoc($studentCheck);

        // 2. Check if already registered
        if (!is_null($student['user_id'])) {
            $error = "Account already created for this student.";
        } else {
            // 3. Check username uniqueness
            $userCheck = mysqli_query(
                $conn,
                "SELECT id FROM users WHERE username = '$username'"
            );

            if (mysqli_num_rows($userCheck) > 0) {
                $error = "Username already exists.";
            } else {
                // 4. Create user account
                mysqli_query(
                    $conn,
                    "INSERT INTO users (username, password, role)
                     VALUES ('$username', '$password', 'student')"
                );

                $user_id = mysqli_insert_id($conn);

                // 5. Link user to student
                mysqli_query(
                    $conn,
                    "UPDATE students SET user_id = $user_id
                     WHERE id = {$student['id']}"
                );

                $success = "Registration successful. You can now log in.";
            }
        }
    }
}
?>
<div class="container">
    <div>
        <h2>Student Registration</h2>

        <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <?php if ($success): ?>
        <p class="success"><?= $success ?></p>
        <?php endif; ?>

        <div class="di-center">

            <form method="POST">
                <input type="text" name="roll_no" placeholder="Roll Number" required>
                <input type="text" name="username" placeholder="Choose Username" required>
                <input type="password" name="password" placeholder="Choose Password" required>
                <button type="submit">Register</button>
            </form>

        </div>

        <a href="login.php">Already registered? Login</a>
    
    </div>

</div>

<?php include '../includes/footer.php'; ?>
