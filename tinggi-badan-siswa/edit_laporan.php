<?php
include 'koneksi.php';
include 'function.php';
include 'templates/header.php';

$id = $_GET['id'];
$lap = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM laporan WHERE id_laporan='$id'"));

if (isset($_POST['submit'])) {
    if (editLaporan($_POST) > 0) {
        echo "<script>alert('Berhasil diubah'); window.location='laporan.php';</script>";
    }
}
?>

<div class="content">
<h1 class="h3 mb-4 text-gray-800">Edit Laporan</h1>

<form action="" method="POST">

    <input type="hidden" name="id_laporan" value="<?= $lap['id_laporan']; ?>">

    <label>Periode</label>
    <input type="text" name="periode" value="<?= $lap['periode']; ?>" required>

    <label>Rata Tinggi</label>
    <input type="number" step="0.1" name="rata_tinggi" value="<?= $lap['rata_tinggi']; ?>" required>

    <label>Pertumbuhan</label>
    <input type="number" step="0.1" name="pertumbuhan" value="<?= $lap['pertumbuhan']; ?>" required>

    <button name="submit">Update</button>
</form>

</div>

<?php 
include 'templates/sidebar.php';
include 'templates/footer.php'; 
?>
