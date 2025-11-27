<?php
include 'function.php';

$id_log = $_GET['id'];

if (hapusLog($id_log) > 0) {
    echo "<script>alert('Log berhasil dihapus'); window.location='log_aktivitas.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus'); window.location='log_aktivitas.php';</script>";
}
?>
