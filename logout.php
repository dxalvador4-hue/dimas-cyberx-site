<?php
session_start();

// Hancurkan cookie Token login permanen di browser klien
if (isset($_COOKIE['remember_node_token'])) {
    setcookie('remember_node_token', '', time() - 3600, "/");
}

session_unset();
session_destroy();

header("Location: login.php");
exit();
?>
