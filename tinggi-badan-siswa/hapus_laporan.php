<?php
include 'function.php';

$id = $_GET['id'];

if (hapusLaporan($id) > 0) {
    echo "<script>alert('Data berhasil dihapus'); window.location='laporan.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus'); window.location='laporan.php';</script>";
}
?>
