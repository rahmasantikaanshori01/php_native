<?php
session_start();
include 'koneksi.php';

$message = '';

if(isset($_POST['reset'])){
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $new_password = $_POST['new_password'];

    $check = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
    if(mysqli_num_rows($check) == 0){
        $message = 'Username tidak ditemukan!';
    } else {
        $hashed = password_hash($new_password, PASSWORD_DEFAULT);
        mysqli_query($koneksi, "UPDATE user SET password='$hashed' WHERE username='$username'");
        $message = 'Password berhasil direset! <a href="login.php">Login</a>';
    }
}
?>

<?php include 'templates/header.php'; ?>

<section class="login-container">
    <h2 style="text-align:center;">Forgot Password</h2>
    <?php if($message != '') echo '<p style="color:red;">'.$message.'</p>'; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <br></br>
        <input type="password" name="new_password" placeholder="New Password" required>
        <br></br>
        <button type="submit" name="reset">Reset Password</button>
    </form>
    <p><a href="login.php">Back to Login</a></p>
</section>

<?php include 'templates/footer.php'; ?>
