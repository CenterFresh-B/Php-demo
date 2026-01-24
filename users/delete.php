<?php
session_start();
include "../config/db.php";

if ($_SESSION["role"] !== "admin") {
    header("Location: ../index.php");
    exit();
}

$id = (int) $_GET["id"];
mysqli_query($conn, "DELETE FROM users WHERE id=$id");

header("Location: view.php");
