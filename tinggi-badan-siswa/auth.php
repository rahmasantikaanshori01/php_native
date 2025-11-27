<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// jika belum login → arahkan ke login.php
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}
?>
