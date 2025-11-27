<?php
session_start();
include 'koneksi.php';

$message = '';

if(isset($_POST['register'])){
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];
    $role = mysqli_real_escape_string($koneksi, $_POST['role']); // pemilik atau guru

    // cek username sudah ada?
    $check = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
    if(mysqli_num_rows($check) > 0){
        $message = 'Username sudah digunakan!';
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($koneksi, "INSERT INTO user(username,password,user_role) VALUES('$username','$hashed','$role')");
        $message = 'Akun berhasil dibuat! <a href="login.php">Login</a>';
    }
}
?>

<?php include 'templates/header.php'; ?>

<section class="login-container">
    <h2 style="text-align:center;">Register</h2>
    <?php if($message != '') echo '<p style="color:red;">'.$message.'</p>'; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <br></br>
        <input type="password" name="password" placeholder="Password" required>
        <br></br>
        <select name="role" required>
            <option value="">--Pilih Role--</option>
            <option value="pemilik">Pemilik</option>
            <option value="guru">Guru</option>
        </select>
        <br></br>
        <button type="submit" name="register">Register</button>
    </form>
    <p><a href="login.php">Back to Login</a></p>
</section>

<?php include 'templates/footer.php'; ?>
