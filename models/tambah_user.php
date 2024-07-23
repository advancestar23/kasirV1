<?php
include "../koneksi/koneksi.php";

// Mendapatkan data dari form
$username = $_POST['username'];
$password = $_POST['password'];
$nama_lengkap = $_POST['namaLengkap'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];
$hakAkses = $_POST['hak_akses'];


// Query untuk menyimpan data stock masuk ke database
$query = "INSERT INTO user (username, password , pass, nama_lengkap, jenis_kelamin, alamat, level) VALUES 
('$username', md5('$password'), '$password', '$nama_lengkap', '$jenis_kelamin', '$alamat', '$hakAkses')";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "User baru berhasil disimpan.";
} else {
    echo "Terjadi kesalahan. Silakan coba lagi.";
}
