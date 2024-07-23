<?php
include "../koneksi/koneksi.php";

// Mendapatkan data dari form
$idproduk = $_POST['produk'];
$tanggalMasuk = $_POST['tanggal_masuk'];
$jumlahMasuk = $_POST['jumlah_masuk'];


// Query untuk menyimpan data stock masuk ke database
$query = "INSERT INTO stock_masuk (id_produk, tanggal_masuk, jumlah_masuk) VALUES ('$idproduk', '$tanggalMasuk', '$jumlahMasuk')";
$result = mysqli_query($koneksi, $query);

// Memperbarui stock produk di tabel "Produk"
$queryUpdateStock = "UPDATE produk SET stock = stock + '$jumlahMasuk' WHERE id_produk = '$idproduk'";
mysqli_query($koneksi, $queryUpdateStock);

if ($result) {
    echo "Stock masuk berhasil disimpan.";
} else {
    echo "Terjadi kesalahan. Silakan coba lagi.";
}
