<?php
include 'auth.php';
include_once('templates/header.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Homepage</h1>

<h2>Tentang Program</h2>
  <p>Aplikasi ini dibuat untuk membantu Sekolah dalam memantau perkembangan tinggi badan siswa secara berkala.</p>
  <p>Fitur utama:</p>
  <ul>
    <li>Input data siswa dan tinggi badan</li>
    <li>Laporan grafik perkembangan per siswa</li>
    <li>Rata-rata tinggi per kelas</li>
    <li>Manajemen user dan log aktivitas</li>
  </ul>
  <p>Dikembangkan oleh Rahma, 2025.</p>

</div>
<!-- /.container-fluid -->


<?php
include_once('templates/sidebar.php');
include_once('templates/footer.php');
?>