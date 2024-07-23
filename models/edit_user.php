<?php
include "../koneksi/koneksi.php";

// Tangkap data dari form
$id_user = $_POST['idUser'];
$username = $_POST['username'];
$password = $_POST['password'];
$nama_lengkap = $_POST['namaLengkap'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$hakAkses = $_POST['hak_akses'];


// Query untuk mengupdate data di dalam tabel produk
$queryEditProduk = "UPDATE user SET username = '$username', password = md5('$password'), 
pass = '$password', nama_lengkap = '$nama_lengkap', 
jenis_kelamin = '$jenis_kelamin', level = '$hakAkses' WHERE kode_user = $id_user";

if (mysqli_query($koneksi, $queryEditProduk)) {
    echo "Produk berhasil diupdate.";
} else {
    echo "Error: " . $queryEditProduk . "<br>" . mysqli_error($koneksi);
}


mysqli_close($koneksi);
