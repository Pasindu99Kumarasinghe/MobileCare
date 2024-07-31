<?php
include 'database_connection.php';

// Fetch customer data from the database
$sql = "SELECT customerName, idNumber, contactNumber, email, address, purchasedItems, billValue FROM customers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row["customerName"]) . "</td>
                <td>" . htmlspecialchars($row["idNumber"]) . "</td>
                <td>" . htmlspecialchars($row["contactNumber"]) . "</td>
                <td>" . htmlspecialchars($row["email"]) . "</td>
                <td>" . htmlspecialchars($row["address"]) . "</td>
                <td>" . htmlspecialchars($row["purchasedItems"]) . "</td>
                <td>" . htmlspecialchars($row["billValue"]) . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='7'>No customers found</td></tr>";
}

$conn->close();
?>
