<div class="container mx-auto mt-4" style="min-height: 504px;">
    <div class="flex justify-between">
        <h2 class="mt-3 mb-3 text-xl font-bold">Stock Masuk</h2>
        <button class="px-4 py-2 my-2 font-semibold text-white bg-green-500 rounded-lg clickAddStock">Stock Masuk</button>
    </div>
    <table class="w-full border border-gray-400" id="myTable">
        <thead>
            <tr>
                <th class="px-4 py-2 border border-gray-400">No.</th>
                <th class="px-4 py-2 border border-gray-400">Nama Produk</th>
                <th class="px-4 py-2 border border-gray-400">Tanggal Masuk</th>
                <th class="px-4 py-2 border border-gray-400">Stock</th>
                <th class="px-4 py-2 border border-gray-400">Gambar</th>
                <th class="px-4 py-2 border border-gray-400">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "koneksi/koneksi.php";
            // Query untuk mendapatkan daftar stock masuk
            $queryStockMasuk = "SELECT stock_masuk.id_stok_masuk, stock_masuk.tanggal_masuk, stock_masuk.jumlah_masuk, produk.id_produk, produk.nama_produk, produk.stock, produk.gambar FROM stock_masuk INNER JOIN produk ON stock_masuk.id_produk = produk.id_produk";
            $resultStockMasuk = mysqli_query($koneksi, $queryStockMasuk);
            // Inisialisasi counter
            $counter = 1;

            // Looping untuk menampilkan daftar stock masuk
            while ($rowStockMasuk = mysqli_fetch_array($resultStockMasuk)) {
                $idbarang = $rowStockMasuk['id_produk'];
                $id_stokmasuk = $rowStockMasuk['id_stok_masuk'];
                $idmasuk = $rowStockMasuk['id_stok_masuk'];
                $tanggal_masuk = $rowStockMasuk['tanggal_masuk'];
                $jumlah_masuk = $rowStockMasuk['jumlah_masuk'];
                $stok = $rowStockMasuk['stock'];
                $nama_produk = $rowStockMasuk['nama_produk'];

                //cek apakah ada gambar
                $gambar = $rowStockMasuk['gambar']; //ambil gambar
                if ($gambar == null) {
                    $img = 'No foto';
                } else {
                    $img = '<img src= "images/' . $gambar . '" class="zoomable">';
                }
            ?>
                <tr>
                    <th class='px-4 py-2 border border-gray-400'> <?= $counter; ?> </th>
                    <th class='px-4 py-2 border border-gray-400'> <?= $nama_produk; ?> </th>
                    <th class='px-4 py-2 border border-gray-400'> <?= $tanggal_masuk; ?> </th>
                    <th class='px-4 py-2 border border-gray-400'> <?= $jumlah_masuk; ?> </th>
                    <th class='px-4 py-2 border border-gray-400'> <?= $img; ?> </th>
                    <th class='px-4 py-2 border border-gray-400'>
                        <button class='px-4 py-2 text-white bg-red-500 rounded-lg' onclick='deleteStockMasuk(<?php echo $rowStockMasuk['id_stok_masuk'] ?>, <?php echo $rowStockMasuk['id_produk'] ?>, <?php echo $rowStockMasuk['stock'] ?>, <?php echo $rowStockMasuk['jumlah_masuk'] ?>)'>Delete</button>
                    </th>
                </tr>
                <?php
                // Increment counter
                $counter++;

                ?>
        </tbody>
        <!-- akhir modal edit stok masuk -->
    <?php
            }
    ?>
    </table>
    <br>
</div>


<!-- awal modal tambah stok masuk -->
<div id="ModalAddStokMasuk" class="fixed inset-0 items-center justify-center hidden pt-32 bg-black modal pl-80 bg-opacity-20">
    <div class="w-2/3 p-6 bg-white rounded-lg shadow-lg modal-content">
        <!-- Tombol untuk menutup modal -->
        <h2 class="mb-4 text-xl font-semibold">Stock Masuk</h2>
        <form id="addbarangmasuk" class="space-y-4">
            <div class="items-center mb-2">
                <label for="produk" class="mr-2">Nama Produk :</label>
                <select name="produk" id="produk" class="w-full px-2 py-1 mt-1 border border-gray-400 rounded-md ">
                    <?php
                    // Query untuk mendapatkan daftar produk
                    $query = "SELECT id_produk, nama_produk FROM produk";
                    $result = mysqli_query($koneksi, $query);

                    // Looping untuk menampilkan daftar produk
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['id_produk'] . "'>" . $row['nama_produk'] . "</option>";
                    }

                    ?>
                </select>
            </div>

            <div class="items-center mb-2">
                <label for="tanggal_masuk" class="mr-2">Tanggal Masuk :</label>
                <input type="date" id="tanggal_masuk" name="tanggal_masuk" class="w-full px-2 py-1 mt-1 border border-gray-400 rounded-md">
            </div>

            <div class="items-center mb-2">
                <label for="jumlah_masuk" class="mr-2">Jumlah Masuk :</label>
                <input type="number" id="jumlah_masuk" name="jumlah_masuk" class="w-full px-2 py-1 mt-1 border border-gray-400 rounded-md">
            </div>

            <div class="flex justify-between">
                <button type="submit" class="px-4 py-2 font-semibold text-white bg-green-500 rounded-lg">Simpan</button>
                <button class="px-4 py-2 font-semibold text-white bg-red-500 rounded-lg close">Cencel</button>
            </div>
        </form>
    </div>
</div>
<!-- akhir modal tambah stok masuk -->

<script>
    const modal = document.getElementById('ModalAddStokMasuk');
    const btn = document.querySelector('.clickAddStock');
    const span = document.getElementsByClassName('close')[0];

    btn.onclick = function() {
        modal.style.display = 'block';
    }

    span.onclick = function() {
        modal.style.display = 'none';
        setTimeout(function() {
            location.reload();
        }, 500);
    }

    window.onclick = function(event) {
        if (event.target === modal) {
            model.style.display = 'none';
        }
    }


    $(document).ready(function() {
        $('#myTable').DataTable();
        // Handler saat form tambah barang di-submit
        $("#addbarangmasuk").submit(function(event) {
            event.preventDefault();

            var form = $(this);
            var url = form.attr("action");

            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                type: "POST",
                url: 'models/tambah_stokMasuk.php',
                data: form.serialize(), // Mengambil data form
                success: function(data) {
                    // Menampilkan pesan respon dari server
                    alert("Pesan : " + data);

                    // Mengosongkan input setelah submit berhasil
                    form.trigger("reset");

                    // Refresh halaman setelah 1 detik
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                },
                error: function() {
                    // Menampilkan pesan error jika terjadi masalah
                    alert("Pesan : Terjadi kesalahan. Silakan coba lagi.");

                }
            });
        });

    });

    // function delete stok masuk
    function deleteStockMasuk(id, idb, idstok, stokmasuk) {
        if (confirm("Apakah Anda yakin ingin menghapus data barang ini?")) {
            $.ajax({
                url: "models/delete_stokMasuk.php",
                type: "POST",
                data: {
                    id: id,
                    idb: idb,
                    idstok: idstok,
                    stokmasuk: stokmasuk
                },
                success: function(response) {
                    // Menampilkan pesan response
                    alert("Pesan Anda: " + response);

                    // Refresh halaman setelah 1 detik
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    }
</script>