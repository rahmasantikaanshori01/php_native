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
include_once('koneksi.php');
include_once('templates/header.php');
?>

<h1 class="h3 mb-4 text-gray-800">Data Kelas</h1>
<a href="tambah_kelas.php" class="button small"> + Tambah Kelas</a><br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID Kelas</th>
        <th>Nama Kelas</th>
        <th>Wali Kelas</th>
        <th>Aksi</th>
    </tr>
    <?php
    $query = mysqli_query($koneksi, "SELECT * FROM kelas");
    while($row = mysqli_fetch_assoc($query)):
    ?>
    <tr>
        <td><?= $row['id_kelas']; ?></td>
        <td><?= $row['nama_kelas']; ?></td>
        <td><?= $row['wali_kelas']; ?></td>
        <td>
            <a href="edit_kelas.php?id=<?= $row['id_kelas']; ?>">Edit</a> | 
            <a href="hapus_kelas.php?id=<?= $row['id_kelas']; ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php 
include_once('templates/sidebar.php');
include_once('templates/footer.php'); 
?>
