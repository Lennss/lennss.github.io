<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BA-Bukan Angkringan</title>
    <link rel="stylesheet" href="styles/content.css">
</head>
<body>
<div class="navbar">
        <header>
            <h1>Bukan Angkringan</h1>
        </header>

        <nav>
            <a href="#home">Home</a>
            <a href="#menu">Menu</a>
            <a href="about-me.html">About Me</a>
            <a href="https://www.instagram.com/aspa.zl/">Kontak</a>
        </nav>

        <label class="switch">
            <input type="checkbox" id="darkModeButton" />
            <span class="slider"></span>
        </label>

        <div class="mobile-menu" id="mobileMenu">
            <a href="#home">Home</a>
            <a href="#menu">Menu</a>
            <a href="about-me.html">About Me</a>
            <a href="https://www.instagram.com/aspa.zl/">Kontak</a>
        </div>

        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="container">
        <!-- Menu Section -->
        <section id="menu">
            <h2 style="text-align: center; margin-bottom: 20px">~ Menu Kami ~</h2>
            <div class="menu">
                <div class="menu-item">
                    <img src="assets/es-lemon.jpg" alt="Es Lemon" />
                    <h3>Es Lemon</h3>
                    <p>Kesegaran air lemon spesial di BA. Pesan sekarang!</p>
                    <button class="openPopup" onclick="openOrderForm('Es Lemon')">Pesan Sekarang</button>
                </div>
                <div class="menu-item">
                    <img src="assets/sayur-asem-merah.jpg" alt="Sayur Asem Merah" />
                    <h3>Sayur Asem Merah</h3>
                    <p>Sayur asem merah dengan perpaduan sayur yang nikmat. Pesan sekarang!</p>
                    <button class="openPopup" onclick="openOrderForm('Sayur Asem Merah')">Pesan Sekarang</button>
                </div>
                <div class="menu-item">
                    <img src="assets/kopi.jpg" alt="Kopi" />
                    <h3>Kopi</h3>
                    <p>Kopi dengan bahan terbaik. Nikmati secangkir kopi spesial.</p>
                    <button class="openPopup" onclick="openOrderForm('Kopi')">Pesan Sekarang</button>
                </div>
                <div class="menu-item">
                    <img src="assets/ayam-bakar.jpg" alt="Ayam Bakar" />
                    <h3>Ayam Bakar</h3>
                    <p>Kenikmatan ayam bakar dengan bumbu tradisional. Pesan sekarang!</p>
                    <button class="openPopup" onclick="openOrderForm('Ayam Bakar')">Pesan Sekarang</button>
                </div>
            </div>
        </section>


        <!-- Pesanan Section -->
        <center>
            <section id="orders">
                <h2 style="text-align: center; margin-bottom: 20px">~ Pesanan Anda ~</h2>
                <div class="orders-table">
                    <table border="2" cellpadding="10" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Menu Item</th>
                                <th>Jumlah</th>
                                <th>Catatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["id"] . "</td>";
                                    echo "<td>" . $row["name"] . "</td>";
                                    echo "<td>" . $row["menu_item"] . "</td>";
                                    echo "<td>" . $row["quantity"] . "</td>";
                                    echo "<td>" . $row["note"] . "</td>";
                                    echo "<td>
                                        <button onclick='editOrder(" . json_encode($row) . ")'>Ubah</button>
                                        <form method='POST' action='' style='display:inline;'>
                                            <input type='hidden' name='id' value='" . $row["id"] . "'>
                                            <button type='submit' name='delete'>Hapus</button>
                                        </form>
                                    </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>Belum ada pesanan</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </center>



        <!-- Notification for submission -->
        <div id="notification" class="notification">
            <?php if ($orderSubmitted) echo "Pesanan telah dikirim!"; ?>
        </div>

        <!-- Popup Form for Orders -->
        <div class="popup" id="popupBox">
            <div class="popup-content">
                <span class="close" onclick="closeOrderForm()">&times;</span>
                <h2>Pesan Sekarang</h2>
                <form id="orderForm" method="POST" action="">
                    <input type="hidden" id="orderId" name="id">
                    <label for="name">Nama:</label>
                    <input type="text" id="name" name="name" required><br><br>

                    <input type="hidden" id="menuItem" name="menuItem"> <!-- Tambahkan input hidden untuk menuItem -->

                    <label for="quantity">Jumlah:</label>
                    <input type="number" id="quantity" name="quantity" min="1" value="1" required><br><br>

                    <label for="note">Catatan:</label>
                    <textarea id="note" name="note" placeholder="Tambahkan catatan..." rows="4"></textarea><br><br>

                    <button type="submit">Kirim Pesanan</button>
                </form>
            </div>
        </div>

    <footer>
        <p>&copy; 2024 BA-Bukan Angkringan.</p>
    </footer>

    <script src="scripts/script.js"></script>

    <script>
        var hamburger = document.getElementById("hamburger");
        var mobileMenu = document.getElementById("mobileMenu");

        hamburger.onclick = function () {
            if (mobileMenu.style.display === "flex") {
                mobileMenu.style.display = "none";
            } else {
                mobileMenu.style.display = "flex";
            }
        };

        function openOrderForm(menuItem) {
            document.getElementById("menuItem").value = menuItem;
            document.getElementById("popupBox").style.display = "flex";
        }

        function closeOrderForm() {
            document.getElementById("popupBox").style.display = "none";
        }

        function editOrder(order) {
            document.getElementById('orderId').value = order.id;
            document.getElementById('name').value = order.name;
            document.getElementById('menuItem').value = order.menu_item;
            document.getElementById('quantity').value = order.quantity;
            document.getElementById('note').value = order.note;
            document.getElementById("popupBox").style.display = "flex";
        }

        window.onclick = function (event) {
            if (event.target == document.getElementById("popupBox")) {
                closeOrderForm();
            }
        };
    </script>
</body>
</html>
