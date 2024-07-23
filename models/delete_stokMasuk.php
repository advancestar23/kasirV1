<?php
// Koneksi ke database
include "../koneksi/koneksi.php";

if (isset($_POST['id'])) {
    $idStockMasuk = $_POST['id'];
    $idbarang = $_POST['idb'];
    $stokbarang = $_POST['idstok'];
    $jumlah_barangmasuk = $_POST['stokmasuk'];

    $getstokbarang = mysqli_query($koneksi, "select * from produk where id_produk = '$idbarang'");
    $data = mysqli_fetch_array($getstokbarang);
    $stok = $data['stock'];

    $selisih = $stok - $jumlah_barangmasuk;
    $update = mysqli_query($koneksi, "update produk set stock='$selisih' where id_produk = '$idbarang'");
    // Query untuk menghapus data stock masuk berdasarkan id
    $queryDeleteStockMasuk = "DELETE FROM stock_masuk WHERE id_stok_masuk = $idStockMasuk";
    $resultDeleteStockMasuk = mysqli_query($koneksi, $queryDeleteStockMasuk);

    if ($resultDeleteStockMasuk && $update) {
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
