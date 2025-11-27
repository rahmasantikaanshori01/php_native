<?php
// mengoneksikan ke database
define('HOST_NAME','localhost');
define('USER_NAME','root');
define('PASSWORD','');
define('DB_NAME','tinggi_badan_siswa');

$koneksi = mysqli_connect(HOST_NAME,USER_NAME,PASSWORD,DB_NAME);
?>