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
include 'koneksi.php';
include 'function.php';
include 'templates/header.php';

// Query tabel laporan + relasi
$lap = mysqli_query($koneksi, "SELECT laporan.*, siswa.nama_siswa, user.username
                            FROM laporan
                            LEFT JOIN siswa ON laporan.nis = siswa.nis
                            LEFT JOIN user ON laporan.dibuat_oleh = user.id_user
                            ORDER BY id_laporan DESC");

// Data untuk grafik
$grafik = mysqli_query($koneksi, "SELECT periode, rata_tinggi, pertumbuhan 
                                 FROM laporan ORDER BY periode ASC");

$label_periode = [];
$data_tinggi = [];
$data_growth = [];

while ($g = mysqli_fetch_assoc($grafik)) {
    $label_periode[] = $g['periode'];
    $data_tinggi[] = $g['rata_tinggi'];
    $data_growth[] = $g['pertumbuhan'];
}
?>

<div class="content">
<h1 class="h3 mb-4 text-gray-800">Laporan Tinggi Badan</h1>

<a href="tambah_laporan.php" class="button small">+ Tambah Laporan</a><br><br>

<!-- Grafik Compact -->
<div class="box" style="padding:10px; background:#fff; margin-bottom:20px; max-width:500px;">
    <h3 style="font-size:17px; margin-bottom:10px;">Grafik Rata-rata Tinggi & Pertumbuhan</h3>
    <div style="height:150px;">
        <canvas id="grafikLaporan" height="40"></canvas>
    </div>
</div>

<table border="1" cellpadding="10" width="100%">
    <tr>
        <th>ID</th>
        <th>NIS</th>
        <th>Nama Siswa</th>
        <th>Periode</th>
        <th>Rata Tinggi</th>
        <th>Pertumbuhan</th>
        <th>Dibuat Oleh</th>
        <th>Dibuat Pada</th>
        <th>Aksi</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($lap)): ?>
    <tr>
        <td><?= $row['id_laporan']; ?></td>
        <td><?= $row['nis']; ?></td>
        <td><?= $row['nama_siswa']; ?></td>
        <td><?= $row['periode']; ?></td>
        <td><?= $row['rata_tinggi']; ?> cm</td>
        <td><?= $row['pertumbuhan']; ?> cm</td>
        <td><?= $row['username']; ?></td>
        <td><?= $row['dibuat_pada']; ?></td>
        <td>
            <a href="edit_laporan.php?id=<?= $row['id_laporan']; ?>">Edit</a> |
            <a href="hapus_laporan.php?id=<?= $row['id_laporan']; ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
</div>

<?php 
include 'templates/sidebar.php';
include 'templates/footer.php'; 
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('grafikLaporan'), {
    type: 'line',
    data: {
        labels: <?= json_encode($label_periode); ?>,
        datasets: [
            {
                label: "Rata-rata Tinggi (cm)",
                data: <?= json_encode($data_tinggi); ?>,
                borderColor: "blue",
                backgroundColor: "rgba(0,0,255,0.2)",
                borderWidth: 2,
                tension: 0.4
            },
            {
                label: "Pertumbuhan (cm)",
                data: <?= json_encode($data_growth); ?>,
                borderColor: "green",
                backgroundColor: "rgba(0,255,0,0.2)",
                borderDash: [5,5],
                borderWidth: 2,
                tension: 0.4
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true } }
    }
});
</script>
