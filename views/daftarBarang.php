<?php
include "koneksi/koneksi.php";
?>
<div class="container mx-auto mt-4" style="min-height: 504px;">
    <div>
        <div class="flex justify-between">
            <h2 class="mt-3 mb-3 text-xl font-bold">Daftar Produk</h2>
            <button class="px-4 py-2 my-2 font-semibold text-white bg-green-500 rounded-lg clickAdd">+ Add
                Produk</button>
        </div>
        <table class="w-full border border-gray-400" id="myTable">
            <thead>
                <tr>
                    <th class="px-4 py-2 border border-gray-400">No.</th>
                    <th class="px-4 py-2 border border-gray-400">Nama Produk</th>
                    <th class="px-4 py-2 border border-gray-400">Harga</th>
                    <th class="px-4 py-2 border border-gray-400">Stock</th>
                    <th class="px-4 py-2 border border-gray-400">Gambar</th>
                    <th class="px-4 py-2 border border-gray-400">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- awal php read tabel barang -->
                <?php
                // Query untuk mendapatkan daftar barang
                $querybarang = "SELECT * FROM produk";
                $resultbarang = mysqli_query($koneksi, $querybarang);

                // Inisialisasi counter
                $counter = 1;
                echo "<tr class ='hidden-row'>";
                echo "<th class='px-4 py-2 border border-gray-400'>" . $counter . "</th>";
                echo "<th class='px-4 py-2 border border-gray-400'>adaada</th>";
                echo "<th class='px-4 py-2 border border-gray-400'>adaada</th>";
                echo "<th class='px-4 py-2 border border-gray-400'>adaada</th>";
                echo "<th class='px-4 py-2 border border-gray-400'>adaada</th>";
                echo "<th class='px-4 py-2 border border-gray-400'>";
                echo "<button class='px-4 py-2 mr-8 bg-yellow-400 rounded-lg clickedit' onclick='editbarang()'>Edit</button>";
                echo "<button class='px-4 py-2 text-white bg-red-500 rounded-lg' onclick='deletebarang()'>Delete</button>";
                echo "</th>";
                echo "</tr>";
                // Looping untuk menampilkan daftar barang
                while ($row = mysqli_fetch_array($resultbarang)) {
                    //cek apakah ada gambar
                    $gambar = $row['gambar']; //ambil gambar
                    if ($gambar == null) {
                        $img = 'No foto';
                    } else {
                        $img = '<img src= "images/' . $gambar . '" class="zoomable">';
                    }
                    echo "<tr>";
                    echo "<th class='px-4 py-2 border border-gray-400'>" . $counter . "</th>";
                    echo "<th class='px-4 py-2 border border-gray-400'>" . $row['nama_produk'] . "</th>";
                    echo "<th class='px-4 py-2 border border-gray-400'>" . $row['harga_produk'] . "</th>";
                    echo "<th class='px-4 py-2 border border-gray-400'>" . $row['stock'] . "</th>";
                    echo "<th class='px-4 py-2 border border-gray-400'>" . $img . "</th>";
                    echo "<th class='px-4 py-2 border border-gray-400'>";
                    echo "<button class='px-4 py-2 mr-8 bg-yellow-400 rounded-lg clickedit' onclick='editbarang(" . $row['id_produk'] . ")'>Edit</button>";
                    echo "<button class='px-4 py-2 text-white bg-red-500 rounded-lg' onclick='deletebarang(" . $row['id_produk'] . ")'>Delete</button>";
                    echo "</th>";
                    echo "</tr>";

                    // Increment counter
                    $counter++;
                }
                ?>
                <!-- akhir php read tabel barang -->
            </tbody>
        </table>
        <br>
    </div>
</div>


<!-- awal  modal tambah barang-->
<div id="ModalAddProduct" class="fixed inset-0 items-center justify-center hidden pt-32 bg-black modal pl-80 bg-opacity-20">
    <div class="w-2/3 p-6 bg-white rounded-lg shadow-lg modal-content">
        <!-- Tombol untuk menutup modal -->
        <h2 class="mb-4 text-xl font-semibold">Tambah Produk</h2>
        <form id="addProductForm" class="space-y-4" enctype="multipart/form-data">

            <div class="flex flex-col">
                <label for="productName" class="font-semibold">Nama Produk:</label>
                <input type="text" id="productName" name="productName" class="p-2 border rounded-lg" required>
            </div>

            <div class="flex flex-col">
                <label for="productPrice" class="font-semibold">Harga:</label>
                <input type="text" id="productPrice" name="productPrice" class="p-2 border rounded-lg" required>
            </div>

            <div class="flex flex-col">
                <label for="productStock" class="font-semibold">Stock:</label>
                <input type="text" id="productStock" name="productStock" class="p-2 border rounded-lg" required>
            </div>

            <div class="flex flex-col">
                <label for="file" class="font-semibold">Gambar:</label>
                <input type="file" id="file" name="file" class="p-2 border rounded-lg">
            </div>
            <div class="flex justify-between">
                <button type="submit" class="px-4 py-2 font-semibold text-white bg-green-500 rounded-lg">Simpan</button>
                <button class="px-4 py-2 font-semibold text-white bg-red-500 rounded-lg close">Cencel</button>
            </div>
        </form>
    </div>
</div>
<!-- akhir modal tambah barang -->

<!-- awal modal edit barang -->
<div id="ModalEditProduct" class="fixed inset-0 items-center justify-center hidden pt-32 bg-black modal pl-80 bg-opacity-20">
    <div class="w-2/3 p-6 bg-white rounded-lg shadow-lg modal-content">
        <h2 class="mb-4 text-xl font-semibold">Edit Produk</h2>
        <button class="px-4 py-2 font-semibold text-white bg-red-500 rounded-lg float-right close2" style="margin-top: -50px;">Batal</button>
        <!-- <img id="previewImage" src="" alt="Preview" style="max-width: 200px; max-height: 200px;"> -->
        <form id="editProductForm" class="space-y-4" enctype="multipart/form-data">
            <input type="hidden" id="editProductId" name="editProductId">
            <div class="flex flex-col">
                <label for="editProductName" class="font-semibold">Nama Produk:</label>
                <input type="text" id="editProductName" name="editProductName" class="p-2 border rounded-lg" required>
            </div>

            <div class="flex flex-col">
                <label for="editProductPrice" class="font-semibold">Harga:</label>
                <input type="text" id="editProductPrice" name="editProductPrice" class="p-2 border rounded-lg" required>
            </div>

            <div class="flex flex-col">
                <label for="editProductStock" class="font-semibold">Stock:</label>
                <input type="text" id="editProductStock" name="editProductStock" class="p-2 border rounded-lg" required>
            </div>

            <div class="flex flex-col">
                <label for="file" class="font-semibold">Gambar:</label>
                <input type="file" id="file" name="file" class="p-2 border rounded-lg">
            </div>

            <div class="flex justify-between">
                <button type="submit" class="px-4 py-2 font-semibold text-white bg-blue-500 rounded-lg">Simpan Perubahan</button>

            </div>
        </form>
    </div>
</div>
<!-- akhir modal edit barang -->


<script>
    // let table = new DataTable('#myTable');
    const modal = document.getElementById('ModalAddProduct');
    const btn = document.querySelector('.clickAdd');
    const span = document.getElementsByClassName('close')[0];

    btn.onclick = function() {
        modal.style.display = 'block';
    }

    span.onclick = function() {
        modal.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    }

    const modal2 = document.getElementById('ModalEditProduct');
    const btn2 = document.querySelector('.clickedit');
    const span2 = document.getElementsByClassName('close2')[0];

    btn2.onclick = function() {
        modal2.style.display = 'block';
    }

    span2.onclick = function() {
        modal2.style.display = 'none';
        setTimeout(function() {
            location.reload();
        }, 500);
    }

    window.onclick = function(event2) {
        if (event2.target === modal2) {
            modal2.style.display = 'none';
        }
    }

    $(document).ready(function() {
        $('#myTable').DataTable();
        // Handler saat form tambah barang di-submit
        // $("#addProductForm").submit(function(event) {
        //     event.preventDefault();

        //     var form = $(this);
        //     var url = form.attr("action");

        //     // Mengirim data ke server menggunakan AJAX
        //     $.ajax({
        //         type: "POST",
        //         url: 'models/tambah_barang.php',
        //         data: form.serialize(), // Mengambil data form
        //         success: function(data) {
        //             // Menampilkan pesan respon dari server
        //             $("#responseMessage").html("<div class='bg-green-200 text-green-800 py-2 px-4 rounded'>" + data + "</div>");

        //             // Mengosongkan input setelah submit berhasil
        //             form.trigger("reset");

        //             // Refresh halaman setelah 1 detik
        //             // setTimeout(function() {
        //             //     location.reload();
        //             // }, 500);
        //         },
        //         error: function() {
        //             // Menampilkan pesan error jika terjadi masalah
        //             $("#responseMessage").html("<div class='bg-red-200 text-red-800 py-2 px-4 rounded'>Terjadi kesalahan. Silakan coba lagi.</div>");
        //         }
        //     });
        // });

        $("#addProductForm").submit(function(event) {
            event.preventDefault();

            var form = $(this);
            var url = form.attr("action");

            var formData = new FormData(form[0]); // Menggunakan FormData untuk pengiriman file

            $.ajax({
                type: "POST",
                url: 'models/tambah_barang.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    alert("Pesan : " + data);
                    form.trigger("reset");
                    // Refresh halaman setelah 1 detik
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                },
                error: function() {
                    alert("Pesan: " + data);
                }
            });
        });


        // Handler saat form edit barang di-submit
        $("#editProductForm").submit(function(event) {
            event.preventDefault();

            var form = $(this);
            var url = form.attr("action");
            var formData = new FormData(form[0]); // Menggunakan FormData untuk pengiriman file
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                type: "POST",
                url: 'models/edit_barang.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    // Menampilkan pesan respon dari server
                    alert("Pesan : " + data);

                    // Mengosongkan input setelah submit berhasil
                    form.trigger("reset");

                    // Menutup modal edit setelah 1 detik
                    setTimeout(function() {
                        $("#ModalEditProduct").hide();
                    }, 100);

                    // // // Refresh halaman setelah 1 detik
                    setTimeout(function() {
                        location.reload();
                    }, 100);
                },
                error: function() {
                    // Menampilkan pesan error jika terjadi masalah
                    alert("Pesan : Terjadi kesalahan. Silakan coba lagi.");

                }
            });
        });


    });

    // Fungsi untuk mengirim request delete barang
    function deletebarang(id) {
        if (confirm("Apakah Anda yakin ingin menghapus data barang ini?")) {
            $.ajax({
                url: "models/delete_barang.php",
                type: "POST",
                data: {
                    id: id
                },
                success: function(response) {
                    // Menampilkan pesan response
                    alert("Pesan : " + response);

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
    function editbarang(id) {
        // Lakukan AJAX request untuk mendapatkan data produk berdasarkan id
        $.ajax({
            url: "models/get_produk.php",
            type: "POST",
            data: {
                id: id
            },

            success: function(data) {
                // Parse data JSON menjadi objek JavaScript
                var productData = JSON.parse(data);
                console.log(productData);

                // Isi nilai input modal edit dengan data produk yang diambil
                $("#editProductId").val(productData.id_produk);
                $("#editProductName").val(productData.nama_produk);
                $("#editProductPrice").val(productData.harga_produk);
                $("#editProductStock").val(productData.stock);

                // Setel sumber gambar untuk pratinjau
                // $("#previewImage").attr("src", "images/" + productData.gambar);

                // Tampilkan modal edit
                $("#ModalEditProduct").show();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
        // span2.onclick = function() {
        //     // Mereset pratinjau gambar
        //     $("#previewImage").attr("src", "");

        //     modal2.style.display = 'none';
        //     setTimeout(function() {
        //         location.reload();
        //     }, 500);
        // }

    }
</script>

</html>