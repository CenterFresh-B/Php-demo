<?php
$conn = mysqli_connect("localhost", "root", "", "formdb");

if (!$conn) {
    die("Database connection failed");
}
