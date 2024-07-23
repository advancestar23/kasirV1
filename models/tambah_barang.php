<?php
include "../koneksi/koneksi.php";

// Mendapatkan data dari form
$nama_barang = $_POST['productName'];
$harga_barang = $_POST['productPrice'];
$stok = $_POST['productStock'];

//soal gambar
$allowed_extension = array('png', 'jpg');
$nama = $_FILES['file']['name']; //ngambil nama file gambar
$dot = explode('.', $nama);
$ekstensi = strtolower(end($dot));
$ukuran = $_FILES['file']['size'];
$file_tmp = $_FILES['file']['tmp_name'];

//penamaan file 
$image = $nama; // menggunakan nama asli file gambar
if (in_array($ekstensi, $allowed_extension) === true) {
    if ($ukuran < 15000000) {
        move_uploaded_file($file_tmp, '../images/' . $image);
        $addtotable = mysqli_query($koneksi, "INSERT INTO Produk (nama_produk, harga_produk,stock,gambar) VALUES ('$nama_barang', '$harga_barang', '$stok', '$image')");

        if ($addtotable) {
            echo "Stock masuk berhasil disimpan.";
        } else {
            echo "Terjadi kesalahan. Silakan coba lagi.";
        }
    } else {
        // kalau lebih dari 15 mb
        echo '
            <script>
                alert("gambar kebesaran");
                // window.location.href="keluar.php";
            </script>';
    }
} else {
    //kalau tidak support
    echo '
            <script>
                alert("File harus png/jpg");
                // window.location.href="index.php";
            </script>';
}

// Query untuk menyimpan data stock masuk ke database
// $query = "INSERT INTO Produk (nama_produk, harga_produk,stock) VALUES ('$nama_barang', '$harga_barang', '$stok')";
// $result = mysqli_query($koneksi, $query);

// if ($result) {
//     echo "Stock masuk berhasil disimpan.";
// } else {
//     echo "Terjadi kesalahan. Silakan coba lagi.";
// }
