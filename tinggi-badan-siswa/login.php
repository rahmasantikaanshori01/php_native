<?php
session_start();
include 'koneksi.php';

$message = '';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
    if (mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);

        if (password_verify($password, $user['password'])) {
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['user_role'];

            header('Location: index.php');
            exit;
        } else {
            $message = 'Password salah!';
        }
    } else {
        $message = 'Username tidak ditemukan!';
    }
}
?>

<?php include 'templates/header.php'; ?>

<style>
body {
    background: linear-gradient(135deg, #667eea, #764ba2);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.login-container {
    width: 400px;
    margin: 100px auto;
    background: #fff;
    padding: 40px 30px;
    border-radius: 12px;
    box-shadow: 0 15px 25px rgba(0,0,0,0.3);
}
.login-container h2 {
    text-align: center;
    margin-bottom: 30px;
    font-weight: 700;
    color: #333;
}
.login-container input {
    width: 100%;
    padding: 12px 15px;
    margin: 10px 0 20px 0;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 16px;
}
.login-container button {
    width: 100%;
    padding: 12px;
    background: #5a67d8;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 18px;
    cursor: pointer;
    transition: background 0.3s ease;

    text-align: center;
    line-height: normal;
    display: inline-block; 
}
.login-container button:hover {
    background: #434190;
}
.login-container p {
    text-align: center;
    font-size: 14px;
}
.login-container p a {
    color: #5a67d8;
    text-decoration: none;
}
.login-container p a:hover {
    text-decoration: underline;
}
.message {
    color: red;
    text-align: center;
    margin-bottom: 15px;
    font-weight: 600;
}
</style>

<div class="login-container">
    <h2>Welcome Back!</h2>
    <?php if ($message !== ''): ?>
        <div class="message"><?= $message ?></div>
    <?php endif; ?>
    <form method="post" autocomplete="off">
        <input type="text" name="username" placeholder="Username" required autofocus>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
    <p><a href="forgot_password.php">Forgot Password?</a> | <a href="register.php">Create an Account</a></p>
</div>

<?php include 'templates/footer.php'; ?>
