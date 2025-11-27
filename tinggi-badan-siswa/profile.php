<?php
include 'auth.php';
include 'koneksi.php';
include 'templates/header.php';

$id_user = $_SESSION['id_user'];
$message = "";

// Ambil data user
$user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id_user'"));

// Update username
if(isset($_POST['update_username'])){
    $new_username = mysqli_real_escape_string($koneksi, $_POST['username']);

    mysqli_query($koneksi,"UPDATE user SET username='$new_username' WHERE id_user='$id_user'");
    $_SESSION['username'] = $new_username;
    $message = "<span style='color:green'>Username berhasil diperbarui.</span>";
}

// Update password
if(isset($_POST['update_password'])){
    $old = $_POST['old_password'];
    $new = $_POST['new_password'];

    $db_pass = $user['password'];

    // cek plaintext
    if($old == $db_pass){
        $hash = password_hash($new, PASSWORD_DEFAULT);
        mysqli_query($koneksi, "UPDATE user SET password='$hash' WHERE id_user='$id_user'");
        $message = "<span style='color:green'>Password berhasil diubah.</span>";
    }
    // cek hashed
    else if(password_verify($old, $db_pass)){
        $hash = password_hash($new, PASSWORD_DEFAULT);
        mysqli_query($koneksi, "UPDATE user SET password='$hash' WHERE id_user='$id_user'");
        $message = "<span style='color:green'>Password berhasil diubah.</span>";
    }
    else {
        $message = "<span style='color:red'>Password lama salah!</span>";
    }
}

// Upload foto profil
if(isset($_POST['update_foto'])){
    $file = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    if($file != ""){
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $newname = "foto_".$id_user.".".$ext;

        move_uploaded_file($tmp, "uploads/".$newname);

        mysqli_query($koneksi, "UPDATE user SET foto='$newname' WHERE id_user='$id_user'");
        $message = "<span style='color:green'>Foto profil berhasil diperbarui.</span>";
    }
}

// update role (hanya pemilik)
if(isset($_POST['update_role']) && $_SESSION['role']=="pemilik"){
    $new_role = $_POST['role'];
    mysqli_query($koneksi, "UPDATE user SET user_role='$new_role' WHERE id_user='$id_user'");
    $_SESSION['role'] = $new_role;
    $message = "<span style='color:green'>Role berhasil diubah.</span>";
}

$user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id_user'"));
?>

<style>
.profile-box {
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    width: 550px;
    margin: 30px auto;
    box-shadow: 0 8px 15px rgba(0,0,0,0.2);
}
.profile-box h2 { text-align:center; margin-bottom:25px; }
.profile-photo { text-align:center; }
.profile-photo img {
    width:140px; height:140px; border-radius:50%; object-fit:cover;
    border:4px solid #5a67d8;
}
.profile-box form input,
.profile-box form select {
    width: 100%; padding: 10px; margin-bottom: 12px;
    border-radius: 6px; border: 1px solid #ccc;
}
.profile-box button {
    width: 100%; padding: 12px; margin-bottom:10px;
    background:#5a67d8; color:#fff; border:none; border-radius:6px;
     text-align: center;
    line-height: normal;
    display: inline-block; 
}
.profile-box button:hover { background:#434190; }
</style>

<div class="profile-box">
    <h2>My Profile</h2>

    <?php if($message) echo "<p>$message</p>"; ?>

    <div class="profile-photo">
        <img src="uploads/<?= $user['foto'] ?: 'default.png' ?>" alt="Foto Profil">
    </div>

    <hr><h3>Ubah Foto Profil</h3>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="foto">
        <button type="submit" name="update_foto">Update Foto</button>
    </form>

    <hr><h3>Informasi Akun</h3>
    <form method="post">
        <label>Username:</label>
        <input type="text" name="username" value="<?= $user['username'] ?>" required>
        <button type="submit" name="update_username">Update Username</button>
    </form>

    <form method="post">
        <label>Role:</label>
        <?php if($_SESSION['role'] == "pemilik"): ?>
            <select name="role">
                <option value="pemilik" <?= $user['user_role']=="pemilik"?"selected":"" ?>>Pemilik</option>
                <option value="guru" <?= $user['user_role']=="guru"?"selected":"" ?>>Guru</option>
            </select>
            <button type="submit" name="update_role">Update Role</button>
        <?php else: ?>
            <input type="text" value="<?= $user['user_role'] ?>" readonly>
        <?php endif; ?>
    </form>

    <hr><h3>Ubah Password</h3>
    <form method="post">
        <input type="password" name="old_password" placeholder="Password Lama" required>
        <input type="password" name="new_password" placeholder="Password Baru" required>
        <button type="submit" name="update_password">Update Password</button>
    </form>
</div>

<?php include 'templates/sidebar.php'; ?>
<?php include 'templates/footer.php'; ?>
