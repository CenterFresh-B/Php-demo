<?php
include '../includes/middleware.php';
requireRole('admin');
include '../db.php';

$error = '';
$success = '';

// 1. Get student ID
if (!isset($_GET['id'])) {
    header("Location: view_students.php");
    exit;
}

$id = (int) $_GET['id'];

// 2. Fetch existing student data
$result = mysqli_query($conn, "SELECT * FROM students WHERE id = $id");

if (mysqli_num_rows($result) !== 1) {
    header("Location: view_students.php");
    exit;
}

$student = mysqli_fetch_assoc($result);

// 3. Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name   = mysqli_real_escape_string($conn, $_POST['name']);
    $roll   = mysqli_real_escape_string($conn, $_POST['roll_no']);
    $email  = mysqli_real_escape_string($conn, $_POST['email']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);

    if (empty($name) || empty($roll) || empty($course)) {
        $error = "Name, Roll No, and Course are required.";
    } else {
        // 4. Prevent duplicate roll number (except current student)
        $check = mysqli_query(
            $conn,
            "SELECT id FROM students 
             WHERE roll_no = '$roll' AND id != $id"
        );

        if (mysqli_num_rows($check) > 0) {
            $error = "Roll number already exists.";
        } else {
            // 5. Update record
            $update = "UPDATE students SET
                        name='$name',
                        roll_no='$roll',
                        email='$email',
                        course='$course'
                       WHERE id=$id";

            if (mysqli_query($conn, $update)) {
                $success = "Student updated successfully.";
                // Refresh data
                $student = mysqli_fetch_assoc(
                    mysqli_query($conn, "SELECT * FROM students WHERE id=$id")
                );
            } else {
                $error = "Error updating student.";
            }
        }
    }
}

include '../includes/header.php';
?>

<h2>Edit Student</h2>

<?php if ($error): ?>
    <p class="error"><?= $error ?></p>
<?php endif; ?>

<?php if ($success): ?>
    <p class="success"><?= $success ?></p>
<?php endif; ?>

<form method="POST">
    <input type="text" name="name"
           value="<?= htmlspecialchars($student['name']) ?>" required>

    <input type="text" name="roll_no"
           value="<?= htmlspecialchars($student['roll_no']) ?>" required>

    <input type="email" name="email"
           value="<?= htmlspecialchars($student['email']) ?>">

    <input type="text" name="course"
           value="<?= htmlspecialchars($student['course']) ?>" required>

    <button type="submit">Update Student</button>
</form>

<a href="view_students.php">⬅ Back to Students</a>

<?php include '../includes/footer.php'; ?>
