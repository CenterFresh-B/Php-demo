<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Registration</title>

<style>
    * {
        box-sizing: border-box;
        font-family: "Inter", "Segoe UI", system-ui, sans-serif;
    }

    body {
        min-height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        background: radial-gradient(circle at top, #6a11cb, #2575fc);
    }

    .card {
        width: 360px;
        padding: 32px;
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 0 25px 40px rgba(0, 0, 0, 0.25);
    }

    .card h2 {
        text-align: center;
        margin-bottom: 24px;
        font-weight: 600;
        color: #333;
    }

    .field {
        margin-bottom: 18px;
    }

    .field label {
        display: block;
        margin-bottom: 6px;
        font-size: 13px;
        color: #555;
    }

    .field input {
        width: 100%;
        padding: 12px 14px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 14px;
        transition: border 0.2s, box-shadow 0.2s;
    }

    .field input:focus {
        outline: none;
        border-color: #2575fc;
        box-shadow: 0 0 0 3px rgba(37, 117, 252, 0.15);
    }

    button {
        width: 100%;
        padding: 14px;
        margin-top: 10px;
        border: none;
        border-radius: 10px;
        background: linear-gradient(to right, #6a11cb, #2575fc);
        color: white;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: transform 0.15s, box-shadow 0.15s;
    }

    button:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.25);
    }

    .footer {
        text-align: center;
        margin-top: 18px;
        font-size: 13px;
        color: #666;
    }
</style>
</head>

<body>

<form class="card" action="insert.php" method="post">
    <h2>Create Account</h2>

    <div class="field">
        <label>Full Name</label>
        <input type="text" name="name" required>
    </div>

    <div class="field">
        <label>Email Address</label>
        <input type="email" name="email" required>
    </div>

    <div class="field">
        <label>Password</label>
        <input type="password" name="password" required>
    </div>

    <button type="submit">Register</button>

    <div class="footer">
        Secure & minimal • PHP + MySQL
    </div>
</form>

</body>
</html>