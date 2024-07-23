<?php
include "../koneksi/koneksi.php";

    // Pastikan variabel ID yang dikirim melalui POST terdefinisi
    if (isset($_POST["idmasuk"])) {
        $id_stokmasuk = $_POST["idmasuk"];

        // Query untuk mendapatkan data produk berdasarkan ID
        $queryGetProduk = "SELECT stock_masuk.id_stok_masuk, stock_masuk.tanggal_masuk, stock_masuk.jumlah_masuk, produk.id_produk, produk.nama_produk, produk.stock FROM stock_masuk INNER JOIN produk ON stock_masuk.id_produk = produk.id_produk
        WHERE stock_masuk.id_stok_masuk = $id_stokmasuk ";
        // $queryGetProduk = "SELECT * FROM produk WHERE id_produk = $id_produk";
        $resultGetProduk = mysqli_query($koneksi, $queryGetProduk);

        // if ($resultGetProduk) {
        //     // Mengambil data produk sebagai array
        //     $dataProduk = mysqli_fetch_assoc($resultGetProduk);

        //     // Mengembalikan data produk dalam format JSON
        //     echo json_encode($dataProduk);
        // } else {
        //     echo "Error: " . $queryGetProduk . "<br>" . mysqli_error($koneksi);
        // }

        if ($resultGetProduk) {
            $dataProduk = mysqli_fetch_assoc($resultGetProduk);
            echo json_encode(["status" => "success", "data" => $dataProduk]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $queryGetProduk . "<br>" . mysqli_error($koneksi)]);
        }
        
    } else {
        echo "ID produk tidak valid.";
    }


mysqli_close($koneksi);
?>
