<?php
session_start();

function requireRole($role) {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== $role) {
        header("Location: /test/student-management/auth/login.php");
        exit;
    }
}
