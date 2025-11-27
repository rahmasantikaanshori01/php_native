<?php
include_once 'koneksi.php';
include_once 'function.php';

$id = $_GET["id"];

// Proses hapus data
$hapus = hapusUser($id);

// Tentukan status
$pesan = $hapus ? "User berhasil dihapus!" : "Gagal menghapus user!";
?>

<?php include_once 'templates/header.php'; ?>


<div id="main">
    <div class="inner">
        <h1>Hapus User</h1>

        <p><?= $pesan; ?></p>

        <!-- Redirect otomatis -->
        <script>
            setTimeout(function() {
                window.location.href = "user.php";
            }, 1500); // 1.5 detik
        </script>

        <p>Anda akan diarahkan ke halaman User...</p>
    </div>
</div>
<?php include_once 'templates/sidebar.php'; ?>
<?php include_once 'templates/footer.php'; ?>
