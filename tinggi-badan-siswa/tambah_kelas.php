<?php
include_once('koneksi.php');
include_once('function.php');
include_once('templates/header.php');

?>

    <div class="inner">
        <h1>Tambah Kelas</h1>

        <?php
        if (isset($_POST['submit'])) {
            if (tambahKelas($_POST) > 0) {
                echo "<script>
                        alert('Data kelas berhasil ditambahkan!');
                        window.location='kelas.php';
                      </script>";
            } else {
                echo "<script>
                        alert('Gagal menambahkan kelas!');
                      </script>";
            }
        }
        ?>

        <form action="" method="POST">
            <label for="nama_kelas">Nama Kelas:</label><br>
            <input type="text" name="nama_kelas" id="nama_kelas" required><br><br>

            <label for="wali_kelas">Wali Kelas:</label><br>
            <input type="text" name="wali_kelas" id="wali_kelas" required><br><br>

            <button type="submit" name="submit" class="button primary">Simpan</button>
        </form>

    </div>

<?php include_once('templates/sidebar.php'); ?>
<?php include_once('templates/footer.php'); ?>
