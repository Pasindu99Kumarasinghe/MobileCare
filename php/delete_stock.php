<?php
// delete_stock.php

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
    $item = $_POST['item'];

    // Prepare and bind
    $sql = "DELETE FROM stock WHERE item = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $item);

    if ($stmt->execute()) {
        echo "Stock deleted successfully!";
        header("Location: ../stock.html"); // Redirect back to stock page
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

