<?php
include 'koneksi.php';
include 'function.php';
include 'templates/header.php';


// list siswa
$siswa = mysqli_query($koneksi, "SELECT * FROM siswa");
// list user
$user = mysqli_query($koneksi, "SELECT * FROM user");

if (isset($_POST['submit'])) {
    if (tambahLaporan($_POST) > 0) {
        echo "<script>alert('Laporan berhasil ditambahkan');window.location='laporan.php';</script>";
    }
}
?>

<div class="content">
<h1 class="h3 mb-4 text-gray-800">Tambah Laporan</h1>

<form action="" method="POST">
    <label>NIS Siswa</label>
    <select name="nis" required>
        <option value="">-- Pilih --</option>
        <?php while($s = mysqli_fetch_assoc($siswa)): ?>
        <option value="<?= $s['nis']; ?>"><?= $s['nis'];?> - <?= $s['nama_siswa']; ?></option>
        <?php endwhile; ?>
    </select>

    <label>Periode</label>
    <input type="text" name="periode" placeholder="Contoh: Semester 1 2025" required>

    <label>Rata-rata Tinggi (cm)</label>
    <input type="number" step="0.1" name="rata_tinggi" required>

    <label>Pertumbuhan (cm)</label>
    <input type="number" step="0.1" name="pertumbuhan" required>

    <label>Dibuat oleh</label>
    <select name="dibuat_oleh" required>
        <?php while($u = mysqli_fetch_assoc($user)): ?>
            <option value="<?= $u['id_user']; ?>"><?= $u['username']; ?></option>
        <?php endwhile; ?>
    </select>
    <br></br>

    <button type="submit" name="submit">Simpan</button>
</form>
</div>

<?php 
include 'templates/sidebar.php';
include 'templates/footer.php'; 
?>
