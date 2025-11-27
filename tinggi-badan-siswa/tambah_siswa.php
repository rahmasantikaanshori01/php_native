<?php
include 'koneksi.php';
include 'function.php';
include 'templates/header.php';


$kelas = mysqli_query($koneksi, "SELECT * FROM kelas");

if (isset($_POST['submit'])) {
    if (tambahSiswa($_POST) > 0) {
        echo "<script>alert('Data berhasil ditambahkan'); window.location='siswa.php';</script>";
    } else {
        echo "<script>alert('Gagal menambah data');</script>";
    }
}
?>

<div class="content">
<h1 class="h3 mb-4 text-gray-800">Tambah Siswa</h1>

<form action="" method="post">

    <label>NIS</label>
    <input type="text" name="nis" required>

    <label>Nama Siswa</label>
    <input type="text" name="nama_siswa" required>

    <label>Kelas</label>
    <input type="text" name="kelas" required>

    <label>Jenis Kelamin</label>
    <select name="jenis_kelamin">
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
    </select>

    <label>Tanggal Lahir</label>
    <input type="date" name="tanggal_lahir" required>
    <br></br>

    <label>Pilih Kelas (Relasi)</label>
    <select name="id_kelas" required>
        <option value="">-- Pilih --</option>
        <?php while($k = mysqli_fetch_assoc($kelas)) : ?>
        <option value="<?= $k['id_kelas']; ?>"><?= $k['nama_kelas']; ?></option>
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
