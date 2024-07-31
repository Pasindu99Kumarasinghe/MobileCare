<?php
include 'database_connection.php';

$result = $conn->query("SELECT * FROM stock");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['item']}</td>
                <td>{$row['brand']}</td>
                <td>{$row['model']}</td>
                <td>{$row['quantity']}</td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No stock available</td></tr>";
}

$conn->close();