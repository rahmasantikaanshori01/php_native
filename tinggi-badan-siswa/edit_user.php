<?php
include_once 'koneksi.php';
include_once 'function.php';

$id = mysqli_real_escape_string($koneksi, $_GET["id"]);

// Ambil data user
$q = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id'");
$user = mysqli_fetch_assoc($q);

include_once 'templates/header.php';

?>

<div id="main">
    <div class="inner">

        <h1>Edit User</h1>

        <form method="POST">
            <input type="hidden" name="id_user" value="<?= $user['id_user']; ?>">

            <label>Username:</label><br>
            <input type="text" name="username" value="<?= $user['username']; ?>" required><br><br>

            <label>Password (kosongkan jika tidak diubah):</label><br>
            <input type="password" name="password"><br><br>

            <label>Role:</label><br>
            <select name="user_role">
                <option value="pemilik" <?= $user['user_role'] == 'pemilik' ? 'selected' : '' ?>>Pemilik</option>
                <option value="guru" <?= $user['user_role'] == 'guru' ? 'selected' : '' ?>>Guru</option>
            </select><br><br>

            <button type="submit" name="ubah" class="button primary">Simpan Perubahan</button>
        </form>

        <?php
        if (isset($_POST["ubah"])) {
            if (editUser($_POST)) {
                echo "<script>alert('User berhasil diubah!'); window.location='user.php';</script>";
            } else {
                echo "<script>alert('Gagal mengubah user!');</script>";
            }
        }
        ?>

    </div>
</div>

<?php
include_once 'templates/sidebar.php'; 
include_once 'templates/footer.php'; ?>
