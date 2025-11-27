<?php
include_once 'koneksi.php';
include_once 'templates/header.php';
include_once 'function.php';

if (isset($_POST["simpan"])) {
    if (tambahUser($_POST)) {
        header("Location: user.php");
        exit;
    }
}
?>

<h2>Tambah User</h2>

<form method="POST">
    Username: <br>
    <input type="text" name="username" required><br><br>

    Password: <br>
    <input type="password" name="password" required><br><br>

    Role: <br>
    <select name="user_role" required>
        <option value="Pemilik">Pemilik</option>
        <option value="guru">Guru</option>
    </select><br><br>

    <button type="submit" name="simpan">Simpan</button>
</form>

<?php 
include_once 'templates/sidebar.php';
include_once 'templates/footer.php';
?>