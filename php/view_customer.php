<?php
// add_customer.php

// Replace with your actual database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerName = $_POST['customerName'];
    $address = $_POST['address'];
    $contactNumber = $_POST['contactNumber'];
    $email = $_POST['email'];
    $purchasedItems = $_POST['purchasedItems'];
    $billValue = $_POST['billValue'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO customers (customerName, address, contactNumber, email, purchasedItems, billValue) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssd", $customerName, $address, $contactNumber, $email, $purchasedItems, $billValue);

    if ($stmt->execute()) {
        echo "Customer details added successfully!";
        header("Location: ../customer.html"); // Redirect back to customer page
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
