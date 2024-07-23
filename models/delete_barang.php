<?php
// Koneksi ke database
include "../koneksi/koneksi.php";

// Cek apakah parameter id ada
if (isset($_POST['id'])) {
    $idproduk = $_POST['id'];

    $gambar = mysqli_query($koneksi, "select * from produk where id_produk='$idproduk'");
    $get = mysqli_fetch_array($gambar);
    $img = '../images/' . $get['gambar'];
    unlink($img);

    // Query untuk menghapus data stock masuk berdasarkan id
    $queryDeleteproduk = "DELETE FROM produk WHERE id_produk = $idproduk";
    $resultDeleteproduk = mysqli_query($koneksi, $queryDeleteproduk);

    if ($resultDeleteproduk) {
        echo "Data stock masuk berhasil dihapus.";
    } else {
        echo "Gagal menghapus data stock masuk.";
    }
} else {
    echo "Parameter id tidak ditemukan.";
    exit;
}

// Tutup koneksi database
mysqli_close($koneksi);
