<?php
include "../koneksi/koneksi.php";

// Pastikan variabel ID yang dikirim melalui POST terdefinisi
if (isset($_POST["id"])) {
    $id_produk = $_POST["id"];

    // Query untuk mendapatkan data produk berdasarkan ID
    $queryGetProduk = "SELECT * FROM produk WHERE id_produk = $id_produk";
    $resultGetProduk = mysqli_query($koneksi, $queryGetProduk);

    if ($resultGetProduk) {
        // Mengambil data produk sebagai array
        $dataProduk = mysqli_fetch_array($resultGetProduk);

        // Mengembalikan data produk dalam format JSON
        echo json_encode($dataProduk);
    } else {
        echo "Error: " . $queryGetProduk . "<br>" . mysqli_error($koneksi);
    }
} else {
    echo "ID produk tidak valid.";
}


mysqli_close($koneksi);
