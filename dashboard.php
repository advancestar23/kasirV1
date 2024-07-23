<div class="container mx-auto mt-4" style="min-height: 504px;">
    <h1 class="mb-4 text-2xl font-bold text-center">Informasi Performa toko</h1>
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h2 class="mb-4 text-lg font-bold">Stok Barang</h2>

            <?php
            // Koneksi ke database
            include "koneksi/koneksi.php";

            // Query untuk menghitung total stock barang
            $queryTotalStockBarang = "SELECT SUM(stock) AS total_stock FROM produk";
            $resultTotalStockBarang = mysqli_query($koneksi, $queryTotalStockBarang);
            $rowTotalStockBarang = mysqli_fetch_assoc($resultTotalStockBarang);
            $totalStockBarang = $rowTotalStockBarang['total_stock'];

            // Menampilkan total stock barang
            echo "<p class='text-3xl font-bold'>$totalStockBarang</p>";
            ?>
        </div>
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h2 class="mb-4 text-lg font-bold">Barang Masuk</h2>
            <?php
            // Query untuk menghitung total barang masuk
            $queryTotalBarangMasuk = "SELECT COUNT(id_produk) AS total_barang_masuk FROM stock_masuk";
            $resultTotalBarangMasuk = mysqli_query($koneksi, $queryTotalBarangMasuk);
            $rowTotalBarangMasuk = mysqli_fetch_assoc($resultTotalBarangMasuk);
            $totalBarangMasuk = $rowTotalBarangMasuk['total_barang_masuk'];

            // Menampilkan total barang masuk
            echo "<p class='text-3xl font-bold'>$totalBarangMasuk</p>";

            ?>
        </div>
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h2 class="mb-4 text-lg font-bold">Transaksi</h2>
            <?php
            // Query untuk menghitung total transaksi
            $queryTotalTransaksi = "SELECT COUNT(*) AS total_transaksi FROM transaksi";
            $resultTotalTransaksi = mysqli_query($koneksi, $queryTotalTransaksi);
            $rowTotalTransaksi = mysqli_fetch_assoc($resultTotalTransaksi);
            $totalTransaksi = $rowTotalTransaksi['total_transaksi'];

            // Menampilkan total transaksi
            echo "<p class='text-3xl font-bold'>$totalTransaksi</p>";
            ?>
        </div>
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h2 class="mb-4 text-lg font-bold">Jumlah User</h2>
            <?php
            // Query untuk menghitung total transaksi
            $queryTotaluser = "SELECT COUNT(*) AS username FROM user";
            $resultTotaluser = mysqli_query($koneksi, $queryTotaluser);
            $rowTotaluser = mysqli_fetch_assoc($resultTotaluser);
            $totaluser = $rowTotaluser['username'];

            // Menampilkan total transaksi
            echo "<p class='text-3xl font-bold'>$totaluser</p>";
            ?>
        </div>
    </div>
</div>