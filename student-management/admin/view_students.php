<?php
include '../includes/middleware.php';
requireRole('admin');
include '../db.php';

$result = mysqli_query($conn, "SELECT * FROM students ORDER BY id DESC");

include '../includes/header.php';
?>
<div class="container">
    <div class="formdi">
    <h2>All Students</h2>

    <?php if (mysqli_num_rows($result) === 0): ?>
        <p>No student records found.</p>
    <?php else: ?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
        <p class="success">Student deleted successfully.</p>
    <?php endif; ?>
        
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Roll No</th>
            <th>Email</th>
            <th>Course</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['roll_no']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['course']) ?></td>
            <td>
                <a href="edit_student.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="delete_student.php?id=<?= $row['id'] ?>"
                onclick="return confirm('Are you sure you want to delete this student?');">
                Delete
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <?php endif; ?>

    <br>
    <a href="dashboard.php">⬅ Back to Dashboard</a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
