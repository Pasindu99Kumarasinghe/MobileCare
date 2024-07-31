<?php
// view_stock.php

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

// Query to fetch stock data
$sql = "SELECT item, category, quantity FROM stock";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["item"] . "</td>
                <td>" . $row["category"] . "</td>
                <td>" . $row["quantity"] . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='3'>No stock available</td></tr>";
}

$conn->close();
