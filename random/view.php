<?php
$conn = mysqli_connect("localhost", "root", "", "formdb");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT id, name, email FROM users";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User List</title>

<style>
    * {
        box-sizing: border-box;
        font-family: "Inter", "Segoe UI", system-ui, sans-serif;
    }

    body {
        min-height: 100vh;
        margin: 0;
        padding: 40px;
        background: linear-gradient(135deg, #1d2671, #c33764);
    }

    .container {
        max-width: 900px;
        margin: auto;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 25px 40px rgba(0, 0, 0, 0.25);
    }

    h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
        font-weight: 600;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        overflow: hidden;
        border-radius: 12px;
    }

    thead {
        background: linear-gradient(to right, #1d2671, #c33764);
        color: white;
    }

    th, td {
        padding: 14px 16px;
        text-align: left;
    }

    th {
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    tbody tr {
        border-bottom: 1px solid #eee;
        transition: background 0.2s;
    }

    tbody tr:hover {
        background: #f5f7ff;
    }

    tbody tr:last-child {
        border-bottom: none;
    }

    .empty {
        text-align: center;
        padding: 20px;
        color: #777;
    }

    .footer {
        margin-top: 18px;
        text-align: center;
        font-size: 13px;
        color: #666;
    }
</style>
</head>

<body>

<div class="container">
    <h2>Registered Users</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3' class='empty'>No users found</td></tr>";
        }

        mysqli_close($conn);
        ?>
        </tbody>
    </table>

    <div class="footer">
        Data fetched securely from MySQL
    </div>
</div>

</body>
</html>