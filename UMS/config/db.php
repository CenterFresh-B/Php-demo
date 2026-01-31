<?php
$conn = mysqli_connect("localhost", "root", "", "ums_db");

if (!$conn) {
    die("Database connection failed");
}
