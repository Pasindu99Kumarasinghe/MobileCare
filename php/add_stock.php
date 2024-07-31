<?php
include 'database_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item = $_POST['item'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $quantity = $_POST['quantity'];

    $stmt = $conn->prepare("INSERT INTO stock (item, brand, model, quantity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $item, $brand, $model, $quantity);

    if ($stmt->execute()) {
        echo "Stock added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}