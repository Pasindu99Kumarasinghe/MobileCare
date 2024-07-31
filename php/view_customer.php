<?php
include 'database_connection.php';

$sql = "SELECT * FROM customers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['customerName']}</td>
                <td>{$row['idNumber']}</td>
                <td>{$row['contactNumber']}</td>
                <td>{$row['email']}</td>
                <td>{$row['address']}</td>
                <td>{$row['purchasedItems']}</td>
                <td>{$row['billValue']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='7'>No customers found</td></tr>";
}

$conn->close();
