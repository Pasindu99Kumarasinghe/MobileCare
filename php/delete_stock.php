<?php
include 'database_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item = $_POST['item'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];

    $stmt = $conn->prepare("DELETE FROM stock WHERE item = ? AND brand = ? AND model = ?");
    $stmt->bind_param("sss", $item, $brand, $model);

    if ($stmt->execute()) {
        echo "Stock deleted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}