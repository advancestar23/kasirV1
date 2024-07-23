<?php
include "../koneksi/koneksi.php";

// Pastikan variabel ID yang dikirim melalui POST terdefinisi
if (isset($_POST["id"])) {
    $id_user = $_POST["id"];

    // Query untuk mendapatkan data user berdasarkan ID
    $queryGetuser = "SELECT * FROM user WHERE kode_user = $id_user";
    $resultGetuser = mysqli_query($koneksi, $queryGetuser);

    if ($resultGetuser) {
        // Pastikan ada data yang ditemukan
        if (mysqli_num_rows($resultGetuser) > 0) {
            // Mengambil data user sebagai array
            $dataUser = mysqli_fetch_array($resultGetuser);

            // Mengembalikan data user dalam format JSON
            echo json_encode($dataUser);
        } else {
            echo "Data user tidak ditemukan.";
        }
    } else {
        echo "Error: " . $queryGetuser . "<br>" . mysqli_error($koneksi);
    }
} else {
    echo "ID User tidak valid.";
}

// mysqli_close($koneksi);
