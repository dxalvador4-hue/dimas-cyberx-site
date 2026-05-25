<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['user_logged'] = true;
    $_SESSION['user_email'] = $_POST['email'] ?? 'unknown';
    $_SESSION['user_name'] = $_POST['name'] ?? 'Guest';
    $_SESSION['user_role'] = $_POST['role'] ?? 'USER';
}
?>
