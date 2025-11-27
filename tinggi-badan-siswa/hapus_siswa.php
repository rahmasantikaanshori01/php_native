<?php
include 'function.php';

$nis = $_GET['nis'];

if (hapusSiswa($nis) > 0) {
    echo "<script>alert('Data berhasil dihapus'); window.location='siswa.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data'); window.location='siswa.php';</script>";
}
?>
