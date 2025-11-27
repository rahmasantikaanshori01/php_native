<?php
include_once('koneksi.php');
include_once('function.php');

if (!isset($_GET['id'])) {
    echo "<script>
            alert('ID tidak ditemukan!');
            window.location='kelas.php';
          </script>";
    exit;
}

$id = $_GET['id'];

if (hapusKelas($id) > 0) {
    echo "<script>
            alert('Data kelas berhasil dihapus!');
            window.location='kelas.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal menghapus data!');
            window.location='kelas.php';
          </script>";
}
