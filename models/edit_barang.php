<?php
include "../koneksi/koneksi.php";

// Tangkap data dari form
$id_produk = $_POST["editProductId"];
$nama_produk = $_POST["editProductName"];
$harga_produk = $_POST["editProductPrice"];
$stock = $_POST["editProductStock"];

//soal gambar
$allowed_extension = array('png', 'jpg');
$nama = $_FILES['file']['name']; //ngambil nama file gambar
$dot = explode('.', $nama);
$ekstensi = strtolower(end($dot));
$ukuran = $_FILES['file']['size'];
$file_tmp = $_FILES['file']['tmp_name'];

//penamaan file 
$image = $nama; // menggunakan nama asli file gambar

if ($ukuran == 0) {
    //jika tidak ingin diupload
    $update = mysqli_query($koneksi, "UPDATE produk SET nama_produk = '$nama_produk', harga_produk = $harga_produk, stock = $stock WHERE id_produk = $id_produk");
    if ($update) {
        echo "Produk berhasil diupdate.";
    } else {
        echo "Error: " . $update . "<br>" . mysqli_error($koneksi);
    }
} else {
    //jika ingin upload
    move_uploaded_file($file_tmp, '../images/' . $image);
    $update = mysqli_query($koneksi, "UPDATE produk SET nama_produk = '$nama_produk', harga_produk = $harga_produk, stock = $stock, gambar = '$image' WHERE id_produk = $id_produk");
    if ($update) {
        echo "Produk berhasil diupdate.";
    } else {
        echo "Error: " . $update . "<br>" . mysqli_error($koneksi);
    }
}
// Query untuk mengupdate data di dalam tabel produk
// $queryEditProduk = "UPDATE produk SET nama_produk = '$nama_produk', harga_produk = $harga_produk, stock = $stock WHERE id_produk = $id_produk";

// if (mysqli_query($koneksi, $queryEditProduk)) {
//     echo "Produk berhasil diupdate.";
// } else {
//     echo "Error: " . $queryEditProduk . "<br>" . mysqli_error($koneksi);
// }


mysqli_close($koneksi);
