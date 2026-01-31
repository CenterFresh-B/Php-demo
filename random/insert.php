<?php
$conn = mysqli_connect("localhost", "root", "", "formdb");

$status = "error";
$message = "Something went wrong. Please try again.";

if ($conn) {

    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])) {

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password)
                VALUES ('$name', '$email', '$password')";

        if (mysqli_query($conn, $sql)) {
            $status = "success";
            $message = "Your account has been created successfully.";
        } else {
            $message = "Database error: " . mysqli_error($conn);
        }

    } else {
        $message = "All fields are required.";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Status</title>

<style>
    * {
        box-sizing: border-box;
        font-family: "Inter", "Segoe UI", system-ui, sans-serif;
    }

    body {
        height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #141e30, #243b55);
    }

    .card {
        width: 360px;
        padding: 30px;
        border-radius: 16px;
        background: white;
        text-align: center;
        box-shadow: 0 25px 40px rgba(0, 0, 0, 0.3);
        animation: fadeIn 0.5s ease;
    }

    .icon {
        width: 60px;
        height: 60px;
        margin: auto;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 28px;
        color: white;
        background: <?= $status === "success" ? "#2ecc71" : "#e74c3c"; ?>;
    }

    h2 {
        margin: 20px 0 10px;
        color: #333;
    }

    p {
        font-size: 14px;
        color: #555;
        margin-bottom: 20px;
    }

    a {
        display: inline-block;
        padding: 12px 18px;
        border-radius: 10px;
        text-decoration: none;
        color: white;
        background: linear-gradient(to right, #667eea, #764ba2);
        transition: transform 0.2s;
    }

    a:hover {
        transform: translateY(-2px);
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
</head>

<body>

<div class="card">
    <div class="icon">
        <?= $status === "success" ? "✓" : "!" ?>
    </div>

    <h2><?= $status === "success" ? "Success" : "Error" ?></h2>
    <p><?= htmlspecialchars($message) ?></p>

    <a href="<?= $status === "success" ? "view.php" : "form.php" ?>">
        <?= $status === "success" ? "View Users" : "Go Back" ?>
    </a>
</div>

</body>
</html>