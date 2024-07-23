<?php
include "../koneksi/koneksi.php";


$items = json_decode($_POST['items']);

if (!empty($items)) {
    foreach ($items as $item) {
        $productId = $item->productId;
        $quantity = $item->quantity;

        // Query untuk mendapatkan harga produk dan stok produk
        $query = "SELECT harga_produk, stock FROM produk WHERE id_produk = '$productId'";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $hargaProduk = $row['harga_produk'];
            $stokProduk = $row['stock'];

            if ($stokProduk >= $quantity) {
                // Hitung total harga
                $totalHarga = $hargaProduk * $quantity;

                // Query untuk menyimpan transaksi
                $query = "INSERT INTO transaksi (id_produk, tanggal_transaksi, jumlah_transaksi, total_harga) 
                          VALUES ('$productId', NOW(), '$quantity', '$totalHarga')";

                // Eksekusi query
                if (!mysqli_query($koneksi, $query)) {
                    echo "Transaksi gagal disimpan.";
                    exit();
                }

                // Kurangi stok produk
                $updatedStokProduk = $stokProduk - $quantity;
                $query = "UPDATE produk SET stock = '$updatedStokProduk' WHERE id_produk = '$productId'";
                mysqli_query($koneksi, $query);
            } else {
                echo "Stok produk tidak mencukupi untuk transaksi ini.";
                exit();
            }
        } else {
            echo "Query gagal dieksekusi.";
            exit();
        }
    }

    echo "Transaksi berhasil disimpan.";
    header("location:../index.php?halaman=Transaksi");
} else {
    echo "Tidak ada item transaksi.";
    header("location:../index.php?halaman=Transaksi");
}

mysqli_close($koneksi);
