<?php
include '../includes/middleware.php';
requireRole('admin');
include '../db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name   = mysqli_real_escape_string($conn, $_POST['name']);
    $roll   = mysqli_real_escape_string($conn, $_POST['roll_no']);
    $email  = mysqli_real_escape_string($conn, $_POST['email']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);

    // 1. Basic validation
    if (empty($name) || empty($roll) || empty($course)) {
        $error = "Name, Roll No, and Course are required.";
    } else {
        // 2. Check unique roll number
        $check = mysqli_query(
            $conn,
            "SELECT id FROM students WHERE roll_no='$roll'"
        );

        if (mysqli_num_rows($check) > 0) {
            $error = "Roll number already exists.";
        } else {
            // 3. Insert student
            $insert = "INSERT INTO students (name, roll_no, email, course)
                       VALUES ('$name', '$roll', '$email', '$course')";

            if (mysqli_query($conn, $insert)) {
                $success = "Student added successfully.";
            } else {
                $error = "Error adding student.";
            }
        }
    }
}

include '../includes/header.php';
?>
<div class="container">
    <div class="formdi">
        <h2>Add Student</h2>

        <?php if ($error): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <?php if ($success): ?>
            <p class="success"><?= $success ?></p>
        <?php endif; ?>
        <div class="di-center">
            <form method="POST">
                <input type="text" name="name" placeholder="Student Name" required>
                <input type="text" name="roll_no" placeholder="Roll Number" required>
                <input type="email" name="email" placeholder="Email">
                <input type="text" name="course" placeholder="Course" required>
                <button type="submit">Add Student</button>
            </form>
        </div>

        <a href="dashboard.php">⬅ Back to Dashboard</a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
