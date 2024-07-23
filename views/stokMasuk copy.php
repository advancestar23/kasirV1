
    <div class="container mx-auto mt-4" style="min-height: 504px;">
        <div class="flex justify-between">
            <h2 class="mt-3 mb-3 text-xl font-bold">Stock Masuk</h2>
            <button class="px-4 py-2 my-2 font-semibold text-white bg-green-500 rounded-lg clickAddStock">Stock Masuk</button>
        </div>
         <div id="responseMessage"></div>
        <table class="w-full border border-gray-400" id="myTable">
            <thead>
                <tr>
                    <th class="px-4 py-2 border border-gray-400">No.</th>
                    <th class="px-4 py-2 border border-gray-400">Nama Produk</th>
                    <th class="px-4 py-2 border border-gray-400">Tanggal Masuk</th>
                    <th class="px-4 py-2 border border-gray-400">Stock</th>
                    <th class="px-4 py-2 border border-gray-400">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "koneksi/koneksi.php";
                // Query untuk mendapatkan daftar stock masuk
                $queryStockMasuk = "SELECT stock_masuk.id_stok_masuk, stock_masuk.tanggal_masuk, stock_masuk.jumlah_masuk, produk.id_produk, produk.nama_produk, produk.stock FROM stock_masuk INNER JOIN produk ON stock_masuk.id_produk = produk.id_produk";
                $resultStockMasuk = mysqli_query($koneksi, $queryStockMasuk);

                // Inisialisasi counter
                $counter = 1;

                // Looping untuk menampilkan daftar stock masuk
                while ($rowStockMasuk = mysqli_fetch_assoc($resultStockMasuk)) {
                    echo "<tr>";
                    echo "<th class='px-4 py-2 border border-gray-400'>" . $counter . "</th>";
                    echo "<th class='px-4 py-2 border border-gray-400'>" . $rowStockMasuk['nama_produk'] . "</th>";
                    echo "<th class='px-4 py-2 border border-gray-400'>" . $rowStockMasuk['tanggal_masuk'] . "</th>";
                    echo "<th class='px-4 py-2 border border-gray-400'>" . $rowStockMasuk['jumlah_masuk'] . "</th>";
                    echo "<th class='px-4 py-2 border border-gray-400'>";
                    echo "<button class='px-4 py-2 mr-8 bg-yellow-400 rounded-lg editbutton' onclick='editStockMasuk(" . $rowStockMasuk['id_stok_masuk'] . "," . $rowStockMasuk['id_produk'] . "," . $rowStockMasuk['stock'] .")'>Edit</button>";
                    echo "<button class='px-4 py-2 text-white bg-red-500 rounded-lg' onclick='deleteStockMasuk(" . $rowStockMasuk['id_stok_masuk'] . "," . $rowStockMasuk['id_produk'] . "," . $rowStockMasuk['stock'] . "," . $rowStockMasuk['jumlah_masuk'] . ")'>Delete</button>";
                    echo "</th>";
                    echo "</tr>";

                    // Increment counter
                    $counter++;
                }
                ?>
            </tbody>
        </table>
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
                    <input type="date" id="tanggal_masuk" name="tanggal_masuk"
                        class="w-full px-2 py-1 mt-1 border border-gray-400 rounded-md">
                </div>

                <div class="items-center mb-2">
                    <label for="jumlah_masuk" class="mr-2">Jumlah Masuk :</label>
                    <input type="number" id="jumlah_masuk" name="jumlah_masuk"
                        class="w-full px-2 py-1 mt-1 border border-gray-400 rounded-md">
                </div>
                
                <div class="flex justify-between">
                    <button type="submit"
                        class="px-4 py-2 font-semibold text-white bg-green-500 rounded-lg">Simpan</button>
                    <button class="px-4 py-2 font-semibold text-white bg-red-500 rounded-lg close">Cencel</button>
                </div>
            </form>
        </div>
    </div>
    <!-- akhir modal tambah stok masuk -->

     <!-- awal modal edit stok masuk -->
     <div id="ModalEditProduct" class="fixed inset-0 items-center justify-center hidden pt-32 bg-black modal pl-80 bg-opacity-20">
        <div class="w-2/3 p-6 bg-white rounded-lg shadow-lg modal-content">
            <h2 class="mb-4 text-xl font-semibold">Edit Produk</h2>
            <button class="px-4 py-2 font-semibold text-white bg-red-500 rounded-lg close1 float-right" style="margin-top:-50px;">Batal</button>
            <form id="editstokmasuk" class="space-y-4" method="post">
                <input type="hidden" id="ideditStokmasuk" name="ideditStokmasuk">
                <input type="hidden" id="idbarang" name="idbarang">
                <input type="hidden" id="stok" name="stok">
                <div class="flex flex-col">
                    <label for="editProductName" class="font-semibold">Nama Produk:</label>
                    <input type="text" id="nama_produk_masuk" name="nama_produk_masuk" class="p-2 border rounded-lg" required>
                </div>

                <div class="flex flex-col">
                    <label for="editProductPrice" class="font-semibold">Jumlah Stok Masuk</label>
                    <input type="number" id="jumlah_stok_masuk" name="jumlah_stok_masuk" class="p-2 border rounded-lg" required>
                </div>

                <div class="flex flex-col">
                    <label for="editProductStock" class="font-semibold">Tanggal Masuk</label>
                    <input type="text" id="tanggal_Masuk" name="tanggal_Masuk" class="p-2 border rounded-lg" required>
                </div>
                <div class="flex justify-between">
                    <button type="submit" class="px-4 py-2 font-semibold text-white bg-blue-500 rounded-lg">Simpan Perubahan</button>
                    <!-- <button class="px-4 py-2 font-semibold text-white bg-red-500 rounded-lg close1">Batal</button> -->
                </div>
                <!-- <div class="flex justify-center">
                <button class="px-4 py-2 font-semibold text-white bg-red-500 rounded-lg close1">Batal</button>
                </div> -->
            </form>
        </div>
    </div>
    <!-- akhir modal edit stok masuk -->



<script>
    const modal = document.getElementById('ModalAddStokMasuk');
    const btn = document.querySelector('.clickAddStock');
    const span = document.getElementsByClassName('close')[0];

    btn.onclick = function () {
        modal.style.display = 'block';
    }

    span.onclick = function () {
        modal.style.display = 'none';
            setTimeout(function() {
                location.reload();
            }, 500);
    }

    window.onclick = function (event) {
        if (event.target === modal) {
            model.style.display = 'none';
        }
    }

    const modal2 = document.getElementById('ModalEditProduct');
    const btn2 = document.querySelector('.editbutton');
    const span2 = document.getElementsByClassName('close1')[0];

    btn2.onclick = function () {
        modal2.style.display = 'block';
    }

    span2.onclick = function () {
        modal2.style.display = 'none';
            setTimeout(function() {
                location.reload();
            }, 500);
    }

    window.onclick = function (event1) {
        if (event1.target === modal2) {
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
                    $("#responseMessage").html("<div class='bg-green-200 text-green-800 py-2 px-4 rounded'>" + data + "</div>");

                    // Mengosongkan input setelah submit berhasil
                    form.trigger("reset");

                     // Refresh halaman setelah 1 detik
                     setTimeout(function() {
                        location.reload();
                    }, 500);
                },
                error: function() {
                    // Menampilkan pesan error jika terjadi masalah
                    $("#responseMessage").html("<div class='bg-red-200 text-red-800 py-2 px-4 rounded'>Terjadi kesalahan. Silakan coba lagi.</div>");
                }
            });
        });
        // Handler saat form edit barang di-submit
        // $("#editstokmasuk").submit(function(event) {
        //     event.preventDefault();

        //     var form = $(this);
        //     var url = form.attr("action");

        //     // Mengirim data ke server menggunakan AJAX
        //     $.ajax({
        //         type: "POST",
        //         url: 'models/edit_stokMasuk.php',
        //         data: form.serialize(),
        //         success: function(data) {
        //             // Menampilkan pesan respon dari server
        //             $("#responseMessage").html("<div class='bg-green-200 text-green-800 py-2 px-4 rounded'>" + data + "</div>");
        //             console.log(data);
        //             // Mengosongkan input setelah submit berhasil
        //             form.trigger("reset");

        //             // Menutup modal edit setelah 1 detik
        //             // setTimeout(function() {
        //             //     $("#ModalEditProduct").hide();
        //             // }, 100);

        //             // Refresh halaman setelah 1 detik
        //             // setTimeout(function() {
        //             //     location.reload();
        //             // }, 100);
        //         },
        //         error: function() {
        //             // Menampilkan pesan error jika terjadi masalah
        //             $("#responseMessage").html("<div class='bg-red-200 text-red-800 py-2 px-4 rounded'>Terjadi kesalahan. Silakan coba lagi.</div>");
        //         }
        //     });
        // });

        $("#editstokmasuk").submit(function (e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "models/edit_stokMasuk.php",
                data: $("#editstokmasuk").serialize(),
                dataType: "json",
                success: function (response) {
                    if (response.status === "success") {
                        alert(response.message);
                        // Lakukan tindakan selanjutnya jika berhasil diupdate
                        // Menutup modal edit setelah 1 detik
                        setTimeout(function() {
                            $("#ModalEditProduct").hide();
                        }, 100);

                        // Refresh halaman setelah 1 detik
                        setTimeout(function() {
                            location.reload();
                        }, 100);
                    } else {
                        alert(response.message);
                    }
                },
                error: function (error) {
                    console.log(error);
                    alert("Terjadi kesalahan saat mengirim permintaan.");
                }
            });
        });
        // Handler saat tombol "Batal" pada modal edit diklik
        $("#ModalEditProduct .close1").click(function() {
            // Menutup modal edit tanpa menampilkan pesan
            $("#ModalEditProduct").hide();
        });
    });

    // function delete stok masuk
    function deleteStockMasuk(id,idb,idstok,stokmasuk) {
        if (confirm("Apakah Anda yakin ingin menghapus data barang ini?")) {
            $.ajax({
                url: "models/delete_stokMasuk.php",
                type: "POST",
                data: {
                    id: id,
                    idb:idb,
                    idstok:idstok,
                    stokmasuk:stokmasuk
                },
                success: function(response) {
                    // Menampilkan pesan response
                    $("#responseMessage").text(response);

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

    // Fungsi untuk menampilkan modal edit
    // function editStockMasuk(idmasuk,idbarang,Stokbarang) {
    //     // Lakukan AJAX request untuk mendapatkan data produk berdasarkan id
    //     $.ajax({
    //         url: "models/get_produk_stokmasuk.php",
    //         type: "POST",
    //         data: {
    //             idmasuk: idmasuk,
    //             idbarang: idbarang,
    //             Stokbarang: Stokbarang
    //         },
            
    //         success: function(data) {
    //             // Parse data JSON menjadi objek JavaScript
    //             console.log(data);
    //             console.log(idmasuk,idbarang,Stokbarang);
    //             var productData = JSON.parse(data);

    //             // Isi nilai input modal edit dengan data produk yang diambil
    //             $("#ideditStokmasuk").val(productData.id_stok_masuk);
    //             $("#nama_produk_masuk").val(productData.nama_produk);
    //             $("#jumlah_stok_masuk").val(productData.jumlah_masuk);
    //             $("#tanggal_Masuk").val(productData.tanggal_masuk);

    //             // Tampilkan modal edit
    //             $("#ModalEditProduct").show();
    //         },
    //         error: function(xhr, status, error) {
    //             console.error(xhr.responseText);
    //         }
    //     });
    // }

        function editStockMasuk(idStokMasuk, idProduk, stock) {
            $.ajax({
                type: "POST",
                url: "models/get_produk_stokmasuk.php",
                data: { idmasuk: idStokMasuk },
                dataType: "json",
                success: function (response) {
                    if (response.status === "success") {
                        // Lakukan tindakan untuk mengisi form edit dengan data yang diterima
                        $("#ideditStokmasuk").val(response.data.id_stok_masuk);
                        $("#nama_produk_masuk").val(response.data.nama_produk);
                        $("#jumlah_stok_masuk").val(response.data.jumlah_masuk);
                        $("#tanggal_Masuk").val(response.data.tanggal_masuk);
                        $("#idbarang").val(response.data.id_produk);
                        $("#stok").val(response.data.stock);
                        

                        // Tampilkan modal edit stok masuk
                        $("#ModalEditProduct").removeClass("hidden");
                    } else {
                        alert(response.message);
                    }
                },
                error: function (error) {
                    console.log(error);
                    alert("Terjadi kesalahan saat mengirim permintaan.");
                }
            });
            
        }
</script>

</html>