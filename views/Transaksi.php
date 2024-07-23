<?php
include "koneksi/koneksi.php";
?>
<div class="container mx-auto mt-4" style="min-height: 504px;">
    <div class="flex" style="height: 30rem;">
        <div class="w-1/2 overflow-auto border-2 rounded-lg shadow-2xl history">
            <p class="mt-3 font-semibold text-center">History Transaksi</p>
            <table class="mt-3 ml-4 border border-collapse ">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border border-gray-400">No</th>
                        <th class="px-4 py-2 border border-gray-400">Nama Produk</th>
                        <th class="px-4 py-2 border border-gray-400">Jumlah Transaksi</th>
                        <th class="px-4 py-2 border border-gray-400">Tanggal Transaksi</th>
                        <th class="px-4 py-2 border border-gray-400">Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query untuk mendapatkan daftar stock masuk
                    $queryTransaksi = "SELECT transaksi.id_transaksi, transaksi.tanggal_transaksi, transaksi.jumlah_transaksi, transaksi.total_harga, produk.id_produk, produk.nama_produk FROM transaksi INNER JOIN produk ON transaksi.id_produk = produk.id_produk ORDER BY transaksi.tanggal_transaksi";
                    $resultTransaksi = mysqli_query($koneksi, $queryTransaksi);

                    // Inisialisasi counter
                    $counter = 1;

                    // Looping untuk menampilkan daftar stock masuk
                    while ($rowTransaksi = mysqli_fetch_assoc($resultTransaksi)) {
                        echo "<tr>";
                        echo "<th class='px-4 py-2 border border-gray-400'>" . $counter . "</th>";
                        echo "<th class='px-4 py-2 border border-gray-400'>" . $rowTransaksi['nama_produk'] . "</th>";
                        echo "<th class='px-4 py-2 border border-gray-400'>" . $rowTransaksi['jumlah_transaksi'] . "</th>";
                        echo "<th class='px-4 py-2 border border-gray-400'>" . $rowTransaksi['tanggal_transaksi'] . "</th>";
                        echo "<th class='px-4 py-2 border border-gray-400'>" . $rowTransaksi['total_harga'] . "</th>";
                        echo "</tr>";

                        // Increment counter
                        $counter++;
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="w-1/2 ml-8 overflow-auto border-2 rounded-lg shadow-2xl transaksi">
            <p class="mt-3 font-semibold text-center">Menu Transaksi</p>
            <form id="transaction-form" action="models/process_Transaksi.php" method="POST">
                <div class="flex flex-row justify-between m-3 header">
                    <label for="Produk" class="mt-2">Produk</label>
                    <select name="product" id="product" class="px-2 py-1 mt-1 border border-gray-400 rounded-md ">
                        <option value="">Pilih Produk</option>
                        <?php

                        // Query untuk mengambil data produk
                        $query = "SELECT * FROM produk";
                        $result = mysqli_query($koneksi, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['id_produk'] . "' data-harga='" . $row['harga_produk'] . "' data-stok='" . $row['stock'] . "'>" . $row['nama_produk'] . "</option>";
                        }
                        ?>
                    </select>
                    <label for="quantity" class="mt-2">Jumlah</label>
                    <input type="number" id="quantity" name="quantity" class="px-2 py-1 border rounded">
                </div>

                <div class="flex justify-center w-full">
                    <button id="add-item" type="button" class="px-4 py-2 my-1 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Tambah</button>
                </div>

                <div style="display:flex; justify-content:center;">
                    <table id="transaction-items" class="mt-2 border border-collapse">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border">Produk</th>
                                <th class="px-4 py-2 border">Jumlah</th>
                                <th class="px-4 py-2 border">Harga</th>
                                <th class="px-4 py-2 border">Total</th>
                                <th class="px-4 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-col justify-center">
                    <label for="total" class="block ml-2 font-medium text-gray-700 ">Total Harga</label>
                    <input id="total" name="total" type="text" readonly class="block p-1 mx-2 mt-1 bg-gray-200 border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="flex flex-col justify-center">
                    <label for="payment" class="block mt-2 ml-2 font-medium text-gray-700">Pembayaran</label>
                    <input id="payment" name="payment" type="text" class="block p-1 mx-2 mt-1 bg-gray-200 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div class="flex flex-col justify-center">
                    <label for="change" class="block mt-2 ml-2 font-medium text-gray-700">Kembalian</label>
                    <input id="change" name="change" type="text" readonly class="block p-1 mx-2 mt-1 bg-gray-200 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <input id="items" name="items" type="hidden" value="">

                <div class="flex justify-center">
                    <button type="submit" id="submit-button" class="px-4 py-2 mt-8 font-bold text-white bg-green-500 rounded hover:bg-green-700">Proses</button>
                </div>
            </form>
        </div>
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

<script>
    $(document).ready(function() {
        var items = [];
        // Membuat dokumen PDF
        const {
            jsPDF
        } = window.jspdf;
        // console.log(jsPDF);
        var doc = new jsPDF({});
        // Handler untuk tombol Tambah
        $("#add-item").click(function() {
            var productId = $("#product").val();
            var productName = $("#product option:selected").text();
            var quantity = $("#quantity").val();
            var price = $("#product option:selected").data("harga");
            var availableStock = parseInt($("#product option:selected").data("stok"));

            if (productId && productName && quantity) {
                // Periksa apakah kuantitas yang dimasukkan lebih besar dari stok yang tersedia
                if (parseInt(quantity) > availableStock) {
                    alert("Stok produk tidak mencukupi untuk transaksi ini.");
                    return;
                }
                var item = {
                    productId: productId,
                    productName: productName,
                    quantity: quantity,
                    price: price
                };

                items.push(item);

                var row = "<tr>";
                row += "<td class='border px-4 py-2'>" + productName + "</td>";
                row += "<td class='border px-4 py-2'>" + quantity + "</td>";
                row += "<td class='border px-4 py-2 price'>" + price + "</td>";
                row += "<td class='border px-4 py-2 total'>" + calculateTotal(price, quantity) + "</td>";
                row += "<td class='border px-4 py-2'><button class='delete-item text-red-500 hover:text-red-700'>Hapus</button></td>";
                row += "</tr>";

                $("#transaction-items tbody").append(row);

                $("#product").val("");
                $("#quantity").val("");

                updateTotal();
            }
        });
        // Handler untuk tombol Hapus
        $("#transaction-items").on("click", ".delete-item", function() {
            $(this).closest("tr").remove();
            updateTotal();
            // Periksa apakah tabel transaction-items kosong
            checkEmptyTable();
        });
        // Handler untuk mengupdate harga dan total
        $("#transaction-items").on("change", "select", function() {
            var productId = $(this).val();
            var quantity = $(this).closest("tr").find("td:eq(1)").text();
            var price = $(this).closest("tr").find(".price").text();

            $(this).closest("tr").find(".total").text(calculateTotal(price, quantity));
            updateTotal();
        });

        // Fungsi untuk mengupdate total harga
        function updateTotal() {
            var total = 0;

            $(".total").each(function() {
                var value = parseInt($(this).text());
                if (!isNaN(value)) {
                    total += value;
                }
            });

            $("#total").val(total);
        }

        // Fungsi untuk menghitung total
        function calculateTotal(price, quantity) {
            var totalPrice = parseInt(price) * parseInt(quantity);
            return isNaN(totalPrice) ? 0 : totalPrice;
        }

        // Handler saat form disubmit
        $("#submit-button").click(function() {
            if (items.length > 0) {
                var payment = parseFloat($("#payment").val());
                var total = parseFloat($("#total").val());

                if (isNaN(payment)) {
                    alert("Silakan masukkan jumlah pembayaran yang valid.");
                    return;
                }

                if (payment < total) {
                    alert("Jumlah pembayaran kurang dari total harga.");
                    return;
                }

                var change = payment - total;
                $("#change").val(change.toFixed(2));

                // Menampilkan alert dengan kembalian
                if (change == 0) {
                    alert("Terima kasih! Uang pas, tidak ada kembalian.");

                    // Menambahkan konten ke PDF
                    doc.text("Struk Pembelian", doc.internal.pageSize.getWidth() / 2, 10, 'center');
                    doc.text("Toko Abadi", doc.internal.pageSize.getWidth() / 2, 20, 'center');
                    doc.text("------------------------------", doc.internal.pageSize.getWidth() / 2, 30, 'center');


                    var yPos = 50;

                    // Meloop item dan menambahkannya ke PDF
                    for (var i = 0; i < items.length; i++) {
                        var item = items[i];
                        doc.text("Produk" + "  " + "Quantity" + "  " + "Harga", 10, 40);
                        doc.text(item.productName + " - " + item.quantity + " x Rp" + item.price, 10, yPos);
                        yPos += 10;
                    }

                    doc.text("------------------------------", 10, yPos);
                    yPos += 10;

                    // Menambahkan total, pembayaran, dan kembalian ke PDF
                    doc.text("Total: Rp" + total.toFixed(2), 10, yPos);
                    yPos += 10;
                    doc.text("Pembayaran: Rp" + payment.toFixed(2), 10, yPos);
                    yPos += 10;
                    doc.text("Kembalian: " + change.toFixed(2), 10, yPos);

                    // Menyimpan PDF
                    var pdfBlob = doc.output('blob'); // Menghasilkan objek Blob dari PDF
                    var pdfUrl = URL.createObjectURL(pdfBlob);

                    // Membuka PDF dalam tab baru
                    window.open(pdfUrl, '_blank');
                } else {
                    alert("Transaksi berhasil!\nKembalian: " + change.toFixed(2));
                    // Menambahkan konten ke PDF
                    doc.text("Struk Pembelian", doc.internal.pageSize.getWidth() / 2, 10, 'center');
                    doc.text("Toko Abadi", doc.internal.pageSize.getWidth() / 2, 20, 'center');
                    doc.text("------------------------------", doc.internal.pageSize.getWidth() / 2, 30, 'center');


                    var yPos = 50;

                    // Meloop item dan menambahkannya ke PDF
                    for (var i = 0; i < items.length; i++) {
                        var item = items[i];
                        doc.text("Produk" + "  " + "Quantity" + "  " + "Harga", 10, 40);
                        doc.text(item.productName + " - " + item.quantity + " x Rp" + item.price, 10, yPos);
                        yPos += 10;
                    }

                    doc.text("------------------------------", 10, yPos);
                    yPos += 10;

                    // Menambahkan total, pembayaran, dan kembalian ke PDF
                    doc.text("Total: Rp" + total.toFixed(2), 10, yPos);
                    yPos += 10;
                    doc.text("Pembayaran: Rp" + payment.toFixed(2), 10, yPos);
                    yPos += 10;
                    doc.text("Kembalian: " + change.toFixed(2), 10, yPos);

                    // Menyimpan PDF
                    var pdfBlob = doc.output('blob'); // Menghasilkan objek Blob dari PDF
                    var pdfUrl = URL.createObjectURL(pdfBlob);

                    // Membuka PDF dalam tab baru
                    window.open(pdfUrl, '_blank');
                }

                $("#items").val(JSON.stringify(items));
                $("#transaction-form").submit();

            } else {
                alert("Belum ada item yang ditambahkan");
            }
        });
    });
    // Fungsi untuk memeriksa apakah tabel transaction-items kosong
    function checkEmptyTable() {
        if ($("#transaction-items tbody tr").length === 0) {
            // Tabel kosong, lakukan refresh halaman
            location.reload();
        }
    }
</script>