<?php
include 'database_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customerName = $_POST['customerName'];
    $idNumber = $_POST['idNumber'];
    $contactNumber = $_POST['contactNumber'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $purchasedItems = $_POST['purchasedItems'];
    $billValue = $_POST['billValue'];

    $stmt = $conn->prepare("INSERT INTO customers (customerName, idNumber, contactNumber, email, address, purchasedItems, billValue) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssd", $customerName, $idNumber, $contactNumber, $email, $address, $purchasedItems, $billValue);

    if ($stmt->execute()) {
        echo "Customer added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}