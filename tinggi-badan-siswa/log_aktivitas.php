<?php
session_start();
if(!isset($_SESSION['id_user'])){
    header('Location: login.php');
    exit;
}
// Hanya guru
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'guru') {
    echo "<script>
            alert('Anda tidak memiliki akses ke halaman ini!');
            window.location.href = 'index.php';
          </script>";
    exit;
}

include 'auth.php';
include 'koneksi.php';
include 'function.php';
include 'templates/header.php';

$log = mysqli_query($koneksi, "SELECT * FROM log_aktivitas ORDER BY id_log DESC");
?>

<div class="content">
<h1 class="h3 mb-4 text-gray-800">Log Aktivitas</h1>
<a href="tambah_aktivitas.php" class="button small"> + Tambah Aktivitas</a><br><br>

<table border="1" cellpadding="10" width="100%">
    <tr>
        <th>ID Log</th>
        <th>ID User</th>
        <th>Aktivitas</th>
        <th>Waktu</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($log)) : ?>
    <tr>
        <td><?= $row['id_log']; ?></td>
        <td><?= $row['id_user']; ?></td>
        <td><?= $row['aktivitas']; ?></td>
        <td><?= $row['waktu']; ?></td>
        <td>
            <a href="hapus_aktivitas.php?id=<?= $row['id_log']; ?>" onclick="return confirm('Hapus log ini?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
</div>

<?php 
include 'templates/sidebar.php';
include 'templates/footer.php';
?>
