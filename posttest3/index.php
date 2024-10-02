<?php
$orderSubmitted = false; 
$menuItem = $quantity = $note = $name = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $menuItem = $_POST['menuItem'];
    $quantity = $_POST['quantity'];
    $note = $_POST['note'];
    $name = $_POST['name'];
    $orderSubmitted = true; 
}
?>

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


        <div id="notification" class="notification"></div>


        <div class="popup" id="popupBox">
            <div class="popup-content">
                <span class="close" onclick="closeOrderForm()">&times;</span>
                <h2>Pesan Sekarang</h2>
                <form id="orderForm" action="#">
                <input type="hidden" id="menuItem" name="menuItem">
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" required><br><br>

                <label for="quantity">Jumlah:</label>
                <input type="number" id="quantity" name="quantity" min="1" value="1" required><br><br>

                <label for="note">Catatan:</label>
                <textarea id="note" name="note" placeholder="Tambahkan catatan..." rows="4"></textarea><br><br>

                <button type="submit">Kirim Pesanan</button>
                </form>
            </div>
        </div>

    </div>

    <footer>
        <p>&copy; 2024 BA-Bukan Angkringan.</p>
    </footer>

    <script src="scripts/script.js"></script>
</body>
</html>
