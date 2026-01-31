<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../dashboard/index.php");
    exit();
}

if (!isset($_GET["id"])) {
    header("Location: view.php");
    exit();
}

$id = (int) $_GET["id"];

/* Prevent admin from deleting themselves */
if ($id === (int) $_SESSION["user_id"]) {
    header("Location: view.php");
    exit();
}

/* Confirm user exists */
$check = mysqli_query($conn, "SELECT id FROM users WHERE id = $id");

if (mysqli_num_rows($check) !== 1) {
    header("Location: view.php");
    exit();
}

/* Perform delete */
mysqli_query($conn, "DELETE FROM users WHERE id = $id");

header("Location: view.php");
exit();
?>