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

$query = mysqli_query($koneksi, 
    "SELECT siswa.*, kelas.nama_kelas 
     FROM siswa 
     INNER JOIN kelas ON kelas.id_kelas = siswa.id_kelas");
?>

<div class="content">
<h1 class="h3 mb-4 text-gray-800">Data Siswa</h1>
<a href="tambah_siswa.php" class="button small"> + Tambah Siswa</a><br><br>

<table border="1" cellpadding="8" width="100%">
    <tr>
        <th>NIS</th>
        <th>Nama Siswa</th>
        <th>Kelas</th>
        <th>Jenis Kelamin</th>
        <th>Tanggal Lahir</th>
        <th>Nama Kelas</th>
        <th>Aksi</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($query)) : ?>
    <tr>
        <td><?= $row['nis']; ?></td>
        <td><?= $row['nama_siswa']; ?></td>
        <td><?= $row['kelas']; ?></td>
        <td><?= $row['jenis_kelamin']; ?></td>
        <td><?= $row['tanggal_lahir']; ?></td>
        <td><?= $row['nama_kelas']; ?></td>
        <td>
            <a href="edit_siswa.php?nis=<?= $row['nis']; ?>">Edit</a>
            <a href="hapus_siswa.php?nis=<?= $row['nis']; ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
</div>

<?php 
include 'templates/sidebar.php';
include 'templates/footer.php'; 
?>
