<?php
include "koneksi/koneksi.php";
?>
<div class="container mx-auto mt-4" style="min-height: 504px;">
    <!-- <div id="responseMessage"></div> -->
    <div>
        <div class="flex justify-between">
            <h2 class="mt-3 mb-3 text-xl font-bold">Daftar User</h2>
            <button class="px-4 py-2 my-2 font-semibold text-white bg-green-500 rounded-lg clickAdd">+ Add
                User</button>
        </div>
        <table class="w-full border border-gray-400" id="myTable">
            <thead>
                <tr>
                    <th class="px-4 py-2 border border-gray-400">No.</th>
                    <!-- <th class="px-4 py-2 border border-gray-400">Gambar</th> -->
                    <th class="px-4 py-2 border border-gray-400">Nama Username</th>
                    <th class="px-4 py-2 border border-gray-400">Nama Lengkap</th>
                    <th class="px-4 py-2 border border-gray-400">Jenis kelamin</th>
                    <th class="px-4 py-2 border border-gray-400">Alamat</th>
                    <th class="px-4 py-2 border border-gray-400">Hak Akses</th>
                    <th class="px-4 py-2 border border-gray-400">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- awal php read tabel barang -->
                <?php
                // Query untuk mendapatkan daftar barang
                $queryuser = "SELECT * FROM user";
                $resultuser = mysqli_query($koneksi, $queryuser);

                // Inisialisasi counter
                $counter = 1;
                echo "<tr class ='hidden-row'>";
                echo "<th class='px-4 py-2 border border-gray-400'>" . $counter . "</th>";
                echo "<th class='px-4 py-2 border border-gray-400'>adaada</th>";
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
                while ($row = mysqli_fetch_array($resultuser)) {
                    //cek apakah ada gambar
                    // $gambar = $row['gambar']; //ambil gambar
                    // if ($gambar == null) {
                    //     $img = 'No foto';
                    // } else {
                    //     $img = '<img src= "images/' . $gambar . '" class="zoomable">';
                    // }
                    echo "<tr>";
                    echo "<th class='px-4 py-2 border border-gray-400'>" . $counter . "</th>";
                    echo "<th class='px-4 py-2 border border-gray-400'>" . $row['username'] . "</th>";
                    echo "<th class='px-4 py-2 border border-gray-400'>" . $row['nama_lengkap'] . "</th>";
                    echo "<th class='px-4 py-2 border border-gray-400'>" . $row['jenis_kelamin'] . "</th>";
                    echo "<th class='px-4 py-2 border border-gray-400'>" . $row['alamat'] . "</th>";
                    echo "<th class='px-4 py-2 border border-gray-400'>" . $row['level'] . "</th>";
                    echo "<th class='px-4 py-2 border border-gray-400'>";
                    echo "<button class='px-4 py-2 mr-8 bg-yellow-400 rounded-lg clickedit' onclick='edituser(" . $row['kode_user'] . ")'>Edit</button>";
                    echo "<button class='px-4 py-2 text-white bg-red-500 rounded-lg' onclick='deleteuser(" . $row['kode_user'] . ")'>Delete</button>";
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
<div id="ModalAddUser" class="fixed inset-0 items-center justify-center hidden pt-32 bg-black modal pl-80 bg-opacity-20" style="margin-top: -110px;">
    <div class="w-2/3 p-6 bg-white rounded-lg shadow-lg modal-content">
        <!-- Tombol untuk menutup modal -->
        <h2 class="mb-4 text-xl font-semibold">Tambah User</h2>
        <form id="adduserForm" class="space-y-4" enctype="multipart/form-data">

            <div class="flex flex-col">
                <label for="username" class="font-semibold">Username:</label>
                <input type="text" id="username" name="username" class="p-2 border rounded-lg" required>
            </div>

            <div class="flex flex-col">
                <label for="password" class="font-semibold">Password:</label>
                <input type="text" id="password" name="password" class="p-2 border rounded-lg" required>
            </div>

            <div class="flex flex-col">
                <label for="namaLengkap" class="font-semibold">Nama Lengkap:</label>
                <input type="text" id="namaLengkap" name="namaLengkap" class="p-2 border rounded-lg" required>
            </div>

            <div class="flex flex-col">
                <label for="jenis_kelamin" class="font-semibold">Jenis Kelamin:</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="p-2 border rounded-lg">
                    <option value="">- Pilih Jenis Kelamin -</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="flex flex-col">
                <label for="alamat" class="font-semibold">Alamat:</label>
                <input type="text" id="alamat" name="alamat" class="p-2 border rounded-lg">
            </div>
            <div class="flex flex-col">
                <label for="hak_akses" class="font-semibold">Hak Akses:</label>
                <select name="hak_akses" id="hak_akses" class="p-2 border rounded-lg">
                    <option value="">- Pilih Hak Akses -</option>
                    <option value="admin">Admin</option>
                    <option value="operator">Operator</option>
                </select>
            </div>
            <div class="flex justify-between">
                <button type="submit" class="px-4 py-2 font-semibold text-white bg-green-500 rounded-lg">Simpan</button>
                <button class="px-4 py-2 font-semibold text-white bg-red-500 rounded-lg close">Cencel</button>
            </div>
        </form>
    </div>
</div>
<!-- akhir modal tambah barang -->

<!-- awal modal edit user -->
<div id="ModalEdituser" class="fixed inset-0 items-center justify-center hidden pt-32 bg-black modal pl-80 bg-opacity-20" style="margin-top: -50px;">
    <div class="w-2/3 p-6 bg-white rounded-lg shadow-lg modal-content">
        <h2 class="mb-4 text-xl font-semibold">Edit User</h2>
        <button class="px-4 py-2 font-semibold text-white bg-red-500 rounded-lg float-right close2" style="margin-top: -50px;">Batal</button>
        <form id="editUserForm" class="space-y-4" enctype="multipart/form-data">
            <input type="hidden" id="idUser1" name="idUser">
            <div class="flex flex-col">
                <label for="username" class="font-semibold">Username:</label>
                <input type="text" id="username1" name="username" class="p-2 border rounded-lg" required>
            </div>

            <div class="flex flex-col">
                <label for="password" class="font-semibold">Password:</label>
                <input type="text" id="password1" name="password" class="p-2 border rounded-lg" required>
            </div>

            <div class="flex flex-col">
                <label for="namaLengkap" class="font-semibold">Nama Lengkap:</label>
                <input type="text" id="namaLengkap1" name="namaLengkap" class="p-2 border rounded-lg"  required>
            </div>

            <div class="flex flex-col">
                <label for="jenis_kelamin" class="font-semibold">Jenis Kelamin:</label>
                <select name="jenis_kelamin" id="jenis_kelamin1">
                    <option value="">- Pilih Jenis Kelamin -</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="hak_akses" class="font-semibold">Hak Akses:</label>
                <select name="hak_akses" id="hak_akses1">
                    <option value="">- Pilih Hak Akses -</option>
                    <option value="admin">Admin</option>
                    <option value="operator">Operator</option>
                </select>
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
    const modal = document.getElementById('ModalAddUser');
    const btn = document.querySelector('.clickAdd');
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
            modal.style.display = 'none';
        }
    }

    const modal2 = document.getElementById('ModalEdituser');
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
        // Handler saat form tambah user di-submit
        $("#adduserForm").submit(function(event) {
            event.preventDefault();

            var form = $(this);
            var url = form.attr("action");

            var formData = new FormData(form[0]); // Menggunakan FormData untuk pengiriman file

            $.ajax({
                type: "POST",
                url: 'models/tambah_user.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#responseMessage").html("<div class='bg-green-200 text-green-800 py-2 px-4 rounded'>" + data + "</div>");
                    form.trigger("reset");
                    // Refresh halaman setelah 1 detik
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                },
                error: function() {
                    $("#responseMessage").html("<div class='bg-red-200 text-red-800 py-2 px-4 rounded'>Terjadi kesalahan. Silakan coba lagi.</div>");
                }
            });
        });


        // Handler saat form edit user di-submit
        $("#editUserForm").submit(function(event) {
            event.preventDefault();

            var form = $(this);
            var url = form.attr("action");
            var formData = new FormData(form[0]); // Menggunakan FormData untuk pengiriman file
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                type: "POST",
                url: 'models/edit_user.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    // Menampilkan pesan respon dari server
                    $("#responseMessage").html("<div class='bg-green-200 text-green-800 py-2 px-4 rounded'>" + data + "</div>");

                    // Mengosongkan input setelah submit berhasil
                    form.trigger("reset");

                    // Menutup modal edit 
                    setTimeout(function() {
                        $("#ModalEdituser").hide();
                    }, 100);

                    // Refresh halaman 
                    setTimeout(function() {
                        location.reload();
                    }, 100);
                },
                error: function() {
                    // Menampilkan pesan error jika terjadi masalah
                    $("#responseMessage").html("<div class='bg-red-200 text-red-800 py-2 px-4 rounded'>Terjadi kesalahan. Silakan coba lagi.</div>");
                }
            });
        });


    });

    // Fungsi untuk mengirim request delete user
    function deleteuser(id) {
        if (confirm("Apakah Anda yakin ingin menghapus data user ini?")) {
            $.ajax({
                url: "models/delete_user.php",
                type: "POST",
                data: {
                    id: id
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
    function edituser(id) {
    // Lakukan AJAX request untuk mendapatkan data user berdasarkan id
    $.ajax({
        url: "models/get_user.php",
        type: "POST",
        data: {
            id: id
        },
        success: function(data) {
            // Parse data JSON menjadi objek JavaScript
            var userData = JSON.parse(data);
            

            // Isi nilai input modal edit dengan data user yang diambil
            $("#idUser1").val(userData.kode_user);
            $("#username1").val(userData.username);
            $("#password1").val(userData.pass);
            $("#namaLengkap1").val(userData.nama_lengkap);
            $("#jenis_kelamin1").val(userData.jenis_kelamin);
            // $("#alamat").val(userData.alamat);
            $("#hak_akses1").val(userData.level);

            // Tampilkan modal edit
            $("#ModalEdituser").show();
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

</script>

</html>