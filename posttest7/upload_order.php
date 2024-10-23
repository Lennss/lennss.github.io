<?php
include 'db.php';

$target_dir = "uploads/";
$maxFileSize = 5 * 1024 * 1024; 
$fileSize = $_FILES["fileToUpload"]["size"];
$fileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
$currentTime = date("Y-m-d H.i.s");

$newFileName = str_replace(' ', '_', $currentTime . '.' . $fileType);
$target_file = $target_dir . $newFileName;

$name = $_POST['name'];
$menu_item = $_POST['menuItem'];
$quantity = $_POST['quantity'];
$note = $_POST['note'];

if (!empty($_FILES["fileToUpload"]["name"])) {
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true); 
    }

    if ($fileSize > $maxFileSize) {
        echo "Sorry, your file is too large. Maximum size allowed is 5MB.";
        exit;
    }

    if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "Sorry, there was an error uploading your file.";
        exit;
    }
} else {
    $newFileName = NULL; 
}

$sql = "INSERT INTO orders (name, menu_item, quantity, note, file_name) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssiss", $name, $menu_item, $quantity, $note, $newFileName);

if ($stmt->execute()) {
    echo "Order successfully submitted!";
    header("Location: index.php"); 
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
