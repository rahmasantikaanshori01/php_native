<?php
session_start();

// Cek apakah user sudah login
if(!isset($_SESSION['id_user'])){
    // Jika belum login, redirect ke login.php
    header('Location: login.php');
    exit;
}
?>
