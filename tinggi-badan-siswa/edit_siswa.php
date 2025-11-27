<?php
include 'koneksi.php';
include 'function.php';
include 'templates/header.php';


$nis = $_GET['nis'];
$siswa = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis'"));
$kelas = mysqli_query($koneksi, "SELECT * FROM kelas");

if (isset($_POST['submit'])) {
    if (editSiswa($_POST) > 0) {
        echo "<script>alert('Data berhasil diupdate'); window.location='siswa.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate data');</script>";
    }
}
?>

<div class="content">
<h1 class="h3 mb-4 text-gray-800">Edit Siswa</h1>

<form action="" method="post">

    <input type="hidden" name="nis" value="<?= $siswa['nis']; ?>">

    <label>Nama Siswa</label>
    <input type="text" name="nama_siswa" value="<?= $siswa['nama_siswa']; ?>" required>

    <label>Kelas</label>
    <input type="text" name="kelas" value="<?= $siswa['kelas']; ?>" required>

    <label>Jenis Kelamin</label>
    <select name="jenis_kelamin">
        <option value="Laki-laki" <?= ($siswa['jenis_kelamin']=='Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
        <option value="Perempuan" <?= ($siswa['jenis_kelamin']=='Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
    </select>

    <label>Tanggal Lahir</label>
    <input type="date" name="tanggal_lahir" value="<?= $siswa['tanggal_lahir']; ?>" required>
    <br></br>

    <label>Pilih Kelas (Relasi)</label>
    <select name="id_kelas">
        <?php while($k = mysqli_fetch_assoc($kelas)) : ?>
            <option value="<?= $k['id_kelas']; ?>" <?= ($siswa['id_kelas']==$k['id_kelas']) ? 'selected':''; ?>>
                <?= $k['nama_kelas']; ?>
            </option>
        <?php endwhile; ?>
    </select>
    <br></br>

    <button type="submit" name="submit">Update</button>
</form>
</div>

<?php 
include 'templates/sidebar.php';
include 'templates/footer.php'; 
?>
