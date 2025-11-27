<?php
session_start();
if(!isset($_SESSION['id_user'])){
    header('Location: login.php');
    exit;
}
// Hanya pemilik
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'pemilik') {
    echo "<script>
            alert('Anda tidak memiliki akses ke halaman ini!');
            window.location.href = 'index.php';
          </script>";
    exit;
}

include 'auth.php';
include_once 'koneksi.php';
include_once 'function.php';
include_once 'templates/header.php';

$users = mysqli_query($koneksi, "SELECT * FROM user");
?>

<div class="content">
<h1 class="h3 mb-4 text-gray-800">Data User</h1>
<a href="tambah_user.php" class="button small"> + Tambah User</a><br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Role</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($users)) : ?>
    <tr>
        <td><?= $row['id_user']; ?></td>
        <td><?= $row['username']; ?></td>
        <td><?= $row['user_role']; ?></td>
        <td>
            <a href="edit_user.php?id=<?= $row['id_user']; ?>">Edit</a> |
            <a href="hapus_user.php?id=<?= $row['id_user']; ?>" onclick="return confirm('Yakin hapus user ini?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
</div>

<?php 
include_once 'templates/sidebar.php';
include_once 'templates/footer.php';
?>
