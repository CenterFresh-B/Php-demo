<?php
include '../includes/middleware.php';
requireRole('student');
include '../db.php';

// Logged-in user ID
$user_id = $_SESSION['user']['id'];

// Fetch student record linked to this user
$query = "SELECT * FROM students WHERE user_id = $user_id LIMIT 1";
$result = mysqli_query($conn, $query);

include '../includes/header.php';

if (mysqli_num_rows($result) === 1) {
    $student = mysqli_fetch_assoc($result);
?>
<div class="container">
    <div>
    <h2>My Profile</h2>

    <p><b>Name:</b> <?= htmlspecialchars($student['name']) ?></p>
    <p><b>Roll No:</b> <?= htmlspecialchars($student['roll_no']) ?></p>
    <p><b>Email:</b> <?= htmlspecialchars($student['email']) ?></p>
    <p><b>Course:</b> <?= htmlspecialchars($student['course']) ?></p>

<?php } else { ?>
    <p>No student profile linked to this account.</p>
<?php } ?>

<a href="dashboard.php">⬅ Back to Dashboard</a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
