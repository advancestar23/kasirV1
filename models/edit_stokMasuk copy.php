<?php
include "../koneksi/koneksi.php";
    // Tangkap data dari form
    $id_stok_masuk = $_POST["ideditStokmasuk"];
    $nama_produk_masuk = $_POST["nama_produk_masuk"];
    $jumlah_masuk = $_POST["jumlah_stok_masuk"];
    $tgl_masuk = $_POST["tanggal_Masuk"];
    $idbarang = $_POST["idbarang"];
    $stokbarang = $_POST["stok"];

    // var_dump($id_stok_masuk,$nama_produk_masuk,$jumlah_masuk,$tgl_masuk,$stokbarang);

    $lihatstok = mysqli_query($koneksi,"select * from produk where id_produk = '$idbarang'");
    $stocknya = mysqli_fetch_array($lihatstok);
    $stok1 = $stocknya['stock'];

    $qtysekarang2 = mysqli_query($koneksi,"select * from stock_masuk where id_stok_masuk = '$id_stok_masuk'");
    $qtynya = mysqli_fetch_array($qtysekarang2);
    $qtysekarang = $qtynya['jumlah_masuk'];

    if ($stokbarang > $qtysekarang) {
        // echo "stokbarang ,$stokbarang ";
        // echo "qtysekarang ,$qtysekarang";

        $selisih = $stokbarang - $qtysekarang;
        $kurangin = $stok1 + $selisih;

        // echo "selisih , $selisih";
        // echo "kurangin , $kurangin";
        $kuranginstok = mysqli_query($koneksi,"update produk set stock = '$kurangin' where id_produk = '$idbarang'");
        $updatenya = mysqli_query($koneksi, "update stock_masuk set jumlah_masuk = '$jumlah_masuk' 
        where id_stok_masuk = '$id_stok_masuk'");
        // if ($kuranginstok && $updatenya) {
        //     echo "Produk berhasil diupdate.";
        // } else {
        //     echo "Error: " . $queryEditProduk . "<br>" . mysqli_error($koneksi);
        // }
            // echo " kuranginstok ", $kuranginstok;
            // echo "updatenya ", $updatenya;
            // var_dump(" kuranginstok ", $kuranginstok);
            // var_dump("updatenya ", $updatenya);
        if ($kuranginstok && $updatenya) {
            echo json_encode(["status" => "success", "message" => "Produk berhasil diupdate."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $queryEditProduk . "<br>" . mysqli_error($koneksi)]);
        }
    } else {
        $selisih = $qtysekarang - $stokbarang;
        $kurangin1 = $stok1 - $selisih;
        // echo "kurangin1 , $kurangin1";
        $kuranginstok = mysqli_query($koneksi,"update produk set stock = '$kurangin1' where id_produk = '$idbarang'");
        $updatenya = mysqli_query($koneksi, "update stock_masuk set jumlah_masuk = '$jumlah_masuk' 
        where id_stok_masuk = '$id_stok_masuk'");

        // echo " kuranginstok ", $kuranginstok;
        // echo "updatenya ", $updatenya;
        // if ($kuranginstok && $updatenya) {
        //     echo "Produk berhasil diupdate.";
        // } else {
        //     echo "Error: " . $queryEditProduk . "<br>" . mysqli_error($koneksi);
        // }

        if ($kuranginstok && $updatenya) {
            echo json_encode(["status" => "success", "message" => "Produk berhasil diupdate."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $queryEditProduk . "<br>" . mysqli_error($koneksi)]);
        }
    }
    // Query untuk mengupdate data di dalam tabel produk
    // $queryEditProduk = "UPDATE produk SET nama_produk = '$nama_produk', harga_produk = $harga_produk, stock = $stock WHERE id_produk = $idproduk";


    // if (mysqli_query($koneksi, $queryEditProduk)) {
    //     echo "Produk berhasil diupdate.";
    // } else {
    //     echo "Error: " . $queryEditProduk . "<br>" . mysqli_error($koneksi);
    // }


mysqli_close($koneksi);
?>
