<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "order_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$orderSubmitted = false;
$menuItem = $quantity = $note = $name = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah tombol delete diklik
    if (isset($_POST['delete'])) {
        // Delete order
        $id = $_POST['id'];
        $stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $orderSubmitted = true;
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // Periksa apakah form tidak kosong dan valid
        $name = $conn->real_escape_string(trim($_POST['name']));
        $menuItem = $conn->real_escape_string(trim($_POST['menuItem']));
        $quantity = $conn->real_escape_string(trim($_POST['quantity']));
        $note = $conn->real_escape_string(trim($_POST['note']));

        if (empty($name) || empty($menuItem) || empty($quantity)) {
            echo "Error: Nama, menu, dan jumlah tidak boleh kosong.";
        } else {
            // Jika ID ada, berarti update data
            if (isset($_POST['id']) && $_POST['id'] != "") {
                $id = $_POST['id'];
                $stmt = $conn->prepare("UPDATE orders SET name=?, menu_item=?, quantity=?, note=? WHERE id=?");
                $stmt->bind_param("ssisi", $name, $menuItem, $quantity, $note, $id);
            } else {
                // Jika ID tidak ada, berarti insert data baru
                $stmt = $conn->prepare("INSERT INTO orders (name, menu_item, quantity, note) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssis", $name, $menuItem, $quantity, $note);
            }

            if ($stmt->execute()) {
                $orderSubmitted = true;
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}

// Fetch all orders
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
?>
