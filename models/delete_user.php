<?php
// Koneksi ke database
include "../koneksi/koneksi.php";

// Cek apakah parameter id ada
if (isset($_POST['id'])) {
    $iduser = $_POST['id'];

    // Query untuk menghapus data stock masuk berdasarkan id
    $queryDeleteuser = "DELETE FROM user WHERE kode_user = $iduser";
    $resultDeleteuser = mysqli_query($koneksi, $queryDeleteuser);

    if ($resultDeleteuser) {
        echo "Data user berhasil dihapus.";
    } else {
        echo "Gagal menghapus data user.";
    }
} else {
    echo "Parameter id tidak ditemukan.";
    exit;
}

// Tutup koneksi database
mysqli_close($koneksi);
