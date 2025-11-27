<?php
include 'koneksi.php';
include 'function.php';
include 'templates/header.php';

if (isset($_POST['submit'])) {
    if (tambahLog($_POST) > 0) {
        echo "<script>alert('Log berhasil ditambahkan'); window.location='log_aktivitas.php';</script>";
    } else {
        echo "<script>alert('Gagal menambah log');</script>";
    }
}
?>

<div class="content">
<h1 class="h3 mb-4 text-gray-800">Tambah Log Aktivitas</h1>

<form action="" method="post">
    <label>ID User</label>
    <input type="number" name="id_user" required>

    <label>Aktivitas</label>
    <textarea name="aktivitas" required></textarea>
    <br></br>

    <button type="submit" name="submit">Simpan</button>
</form>
</div>

<?php 
include 'templates/sidebar.php';
include 'templates/footer.php'; 
?>
