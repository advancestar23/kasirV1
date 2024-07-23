<?php
@$page = $_GET['halaman'];
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dist/tailwind.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    
    <title>Kasir App | <?= @$page ?></title>
    <style>
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #aaa;
            border-radius: 2px;
            background-color: transparent;
            color: inherit;
            margin-left: 8px;
            margin-bottom: 10px;
        }

        .hidden-row {
            display: none;
            color: white;
        }

        .zoomable {
            width: 200px;
            /* margin-left: 80px; */
        }

        .zoomable:hover {
            transform: scale(2.5);
            transition: 0.3s ease;
        }

        a {
            text-decoration: none;
            color: aqua;
        }
    </style>
</head>

<body>
    <nav class="bg-gray-800">
        <div class="container px-6 py-3 mx-auto">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <a class="mr-4 text-lg font-semibold text-white" href="?halaman=welcome">KASIR APP</a>
                    <ul class="flex space-x-4">
                        <!-- <li><a class="text-gray-300 hover:text-white" href="?halaman=daftarBarang">Daftar Barang</a>
                        </li>
                        <li><a class="text-gray-300 hover:text-white" href="?halaman=stokMasuk">Stok Masuk</a></li>
                        <li><a class="text-gray-300 hover:text-white" href="?halaman=Transaksi">Transaksi</a></li>
                        <li><a class="text-gray-300 hover:text-white" href="?halaman=User">User</a></li> -->
                        <?php if ($_SESSION["user"]["level"] == "admin") : ?>
                            <!-- Tampilkan menu yang hanya diperlukan oleh admin -->
                            <li><a class="text-gray-300 hover:text-white" href="?halaman=daftarBarang">Daftar Barang</a>
                            <li><a class="text-gray-300 hover:text-white" href="?halaman=stokMasuk">Stok Masuk</a></li>
                            <li><a class="text-gray-300 hover:text-white" href="?halaman=Transaksi">Transaksi</a></li>
                            <li><a class="text-gray-300 hover:text-white" href="?halaman=User">User</a></li>
                        <?php else : ?>
                            <!-- Tampilkan menu yang diperlukan oleh operator -->
                            <li><a class="text-gray-300 hover:text-white" href="?halaman=daftarBarang">Daftar Barang</a>
                            </li>
                            <li><a class="text-gray-300 hover:text-white" href="?halaman=Transaksi">Transaksi</a></li>
                            <!-- Di sini Anda dapat menambahkan menu tambahan jika diperlukan -->
                        <?php endif; ?>
                        <li>
                            <a class="text-gray-300 hover:text-white" href="?action=logout">Log Out</a>
                            <span class="text-gray-300 mr-2 text-white" style="margin-left: 30px;">Selamat datang, <?php echo $_SESSION["user"]["nama_lengkap"]; ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>


    <?php

    // if ($page == "welcome" || $page == null) {
    //     include "dashboard.php";
    // } elseif ($page == "daftarBarang") {
    //     include "views/daftarBarang.php";
    // } elseif ($page == "stokMasuk") {
    //     include "views/stokMasuk.php";
    // } elseif ($page == "stock_keluar") {
    //     include "stock_keluar.php";
    // } elseif ($page == "Transaksi") {
    //     include "views/Transaksi.php";
    // } elseif ($page == "User") {
    //     include "views/User.php";
    // } 
    $userLevel = $_SESSION["user"]["level"];

    if ($userLevel == "admin") {
        // Admin memiliki akses ke semua halaman
        if ($page == "welcome" || $page == null) {
            include "dashboard.php";
        } elseif ($page == "daftarBarang") {
            include "views/daftarBarang.php";
        } elseif ($page == "stokMasuk") {
            include "views/stokMasuk.php";
        } elseif ($page == "stock_keluar") {
            include "stock_keluar.php";
        } elseif ($page == "Transaksi") {
            include "views/Transaksi.php";
        } elseif ($page == "User") {
            include "views/User.php";
        }
    } elseif ($userLevel == "operator") {
        // Operator memiliki akses terbatas
        if ($page == "welcome" || $page == null) {
            include "dashboard.php";
        } elseif ($page == "Transaksi") {
            include "views/Transaksi.php";
        } elseif ($page == "daftarBarang" || $page == null) {
            include "views/daftarBarang.php";
        } else {
            // Tampilkan alert untuk akses tidak sah
            echo '<script>alert("Akses tidak sah!");</script>';
            // Redirect ke halaman welcome
            header("Location: index.php?halaman=welcome");
            exit();
        }
    }
    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_destroy();
        header("Location: login.php");
        exit();
    }
    ?>

    <footer class="p-4 text-white bg-gray-800">
        <div class="container mx-auto text-center">
            <p>&copy; 2023 Your Company. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>