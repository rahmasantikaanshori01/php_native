<?php
include_once('koneksi.php');
include_once('function.php');
include_once('templates/header.php');

?>

    <div class="inner">
        <h1>Edit Data Kelas</h1>

        <?php
        if (!isset($_GET['id'])) {
            echo "<script>
                    alert('ID tidak ditemukan!');
                    window.location='kelas.php';
                  </script>";
            exit;
        }

        $id = $_GET['id'];
        $result = mysqli_query($koneksi, "SELECT * FROM kelas WHERE id_kelas = '$id'");
        $row = mysqli_fetch_assoc($result);

        if (!$row) {
            echo "<script>
                    alert('Data tidak ditemukan!');
                    window.location='kelas.php';
                  </script>";
            exit;
        }

        if (isset($_POST['submit'])) {
            if (ubahKelas($_POST) > 0) {
                echo "<script>
                        alert('Data berhasil diubah!');
                        window.location='kelas.php';
                      </script>";
            } else {
                echo "<script>alert('Tidak ada perubahan data!');</script>";
            }
        }
        ?>

        <form action="" method="POST">
            <input type="hidden" name="id_kelas" value="<?= $row['id_kelas']; ?>">

            <label for="nama_kelas">Nama Kelas</label><br>
            <input type="text" name="nama_kelas" id="nama_kelas" value="<?= $row['nama_kelas']; ?>" required><br><br>

            <label for="wali_kelas">Wali Kelas</label><br>
            <input type="text" name="wali_kelas" id="wali_kelas" value="<?= $row['wali_kelas']; ?>" required><br><br>

            <button type="submit" name="submit" class="button primary">Simpan Perubahan</button>
        </form>

    </div>

<?php include_once('templates/sidebar.php'); ?>
<?php include_once('templates/footer.php'); ?>
