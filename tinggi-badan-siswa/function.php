<?php
// Sambungkan ke database
include_once 'koneksi.php';

/*
|--------------------------------------
|  FUNGSI TAMBAH DATA KELAS
|--------------------------------------
*/
function tambahKelas($data)
{
    global $koneksi;

    $nama_kelas = htmlspecialchars($data['nama_kelas']);
    $wali_kelas = htmlspecialchars($data['wali_kelas']);

    $query = "INSERT INTO kelas (nama_kelas, wali_kelas) 
              VALUES ('$nama_kelas', '$wali_kelas')";
    
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

/*
|--------------------------------------
|  FUNGSI UBAH DATA KELAS
|--------------------------------------
*/
function ubahKelas($data)
{
    global $koneksi;

    $id_kelas   = $data['id_kelas'];
    $nama_kelas = htmlspecialchars($data['nama_kelas']);
    $wali_kelas = htmlspecialchars($data['wali_kelas']);

    $query = "UPDATE kelas SET
                nama_kelas = '$nama_kelas',
                wali_kelas = '$wali_kelas'
              WHERE id_kelas = '$id_kelas'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

/*
|--------------------------------------
|  FUNGSI HAPUS DATA KELAS
|--------------------------------------
*/
function hapusKelas($id)
{
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM kelas WHERE id_kelas = '$id'");

    return mysqli_affected_rows($koneksi);
}

/* ============================
   TAMBAH SISWA
============================ */
function tambahSiswa($data)
{
    global $koneksi;

    $nis            = $data['nis'];
    $nama_siswa     = $data['nama_siswa'];
    $kelas          = $data['kelas'];
    $jenis_kelamin  = $data['jenis_kelamin'];
    $tanggal_lahir  = $data['tanggal_lahir'];
    $id_kelas       = $data['id_kelas'];

    $query = "INSERT INTO siswa 
              (nis, nama_siswa, kelas, jenis_kelamin, tanggal_lahir, id_kelas)
              VALUES 
              ('$nis', '$nama_siswa', '$kelas', '$jenis_kelamin', '$tanggal_lahir', '$id_kelas')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

/* ============================
   EDIT / UPDATE SISWA
============================ */
function editSiswa($data)
{
    global $koneksi;

    $nis            = $data['nis'];
    $nama_siswa     = $data['nama_siswa'];
    $kelas          = $data['kelas'];
    $jenis_kelamin  = $data['jenis_kelamin'];
    $tanggal_lahir  = $data['tanggal_lahir'];
    $id_kelas       = $data['id_kelas'];

    $query = "UPDATE siswa SET 
                nama_siswa = '$nama_siswa',
                kelas = '$kelas',
                jenis_kelamin = '$jenis_kelamin',
                tanggal_lahir = '$tanggal_lahir',
                id_kelas = '$id_kelas'
              WHERE nis = '$nis'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

/* ============================
   HAPUS SISWA
============================ */
function hapusSiswa($nis)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM siswa WHERE nis = '$nis'");
    return mysqli_affected_rows($koneksi);
}

// ======================================
// FUNGSI CRUD LOG AKTIVITAS
// ======================================

function tambahLog($data) {
    global $koneksi;

    $id_user = $data['id_user'];
    $aktivitas = htmlspecialchars($data['aktivitas']);
    $waktu = date('Y-m-d H:i:s');

    $query = "INSERT INTO log_aktivitas VALUES ('', '$id_user', '$aktivitas', '$waktu')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function hapusLog($id_log) {
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM log_aktivitas WHERE id_log = $id_log");
    return mysqli_affected_rows($koneksi);
}

// =============================
// CRUD LAPORAN
// =============================

function tambahLaporan($data) {
    global $koneksi;

    $nis = $data['nis'];
    $periode = htmlspecialchars($data['periode']);
    $rata_tinggi = $data['rata_tinggi'];
    $pertumbuhan = $data['pertumbuhan'];
    $dibuat_oleh = $data['dibuat_oleh'];
    $dibuat_pada = date("Y-m-d H:i:s");

    $query = "INSERT INTO laporan VALUES
              ('', '$nis', '$periode', '$rata_tinggi', '$pertumbuhan', '$dibuat_oleh', '$dibuat_pada')";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function hapusLaporan($id_laporan) {
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM laporan WHERE id_laporan='$id_laporan'");
    return mysqli_affected_rows($koneksi);
}

function editLaporan($data) {
    global $koneksi;

    $id_laporan = $data['id_laporan'];
    $periode = $data['periode'];
    $rata_tinggi = $data['rata_tinggi'];
    $pertumbuhan = $data['pertumbuhan'];

    mysqli_query($koneksi, "
        UPDATE laporan SET
        periode='$periode',
        rata_tinggi='$rata_tinggi',
        pertumbuhan='$pertumbuhan'
        WHERE id_laporan='$id_laporan'
    ");

    return mysqli_affected_rows($koneksi);
}

// ============================
// FUNCTION USER
// ============================

// Create User
function tambahUser($data)
{
    global $koneksi;

    $username = $data["username"];
    $password = password_hash($data["password"], PASSWORD_DEFAULT); 
    $role = $data["user_role"];

    $query = "INSERT INTO user (username, password, user_role)
              VALUES ('$username', '$password', '$role')";
    return mysqli_query($koneksi, $query);
}

// Edit User
function editUser($data)
{
    global $koneksi;

    $id = $data["id_user"];
    $username = $data["username"];
    $role = $data["user_role"];

    // Jika password tidak diubah
    if ($data["password"] == "") {
        $query = "UPDATE user SET 
                  username = '$username',
                  user_role = '$role'
                  WHERE id_user = $id";
    } else {
        // Jika password diganti
        $password = password_hash($data["password"], PASSWORD_DEFAULT);
        $query = "UPDATE user SET 
                  username = '$username',
                  password = '$password',
                  user_role = '$role'
                  WHERE id_user = $id";
    }

    return mysqli_query($koneksi, $query);
}

// Hapus User
function hapusUser($id)
{
    global $koneksi;
    return mysqli_query($koneksi, "DELETE FROM user WHERE id_user = $id");
}

?>