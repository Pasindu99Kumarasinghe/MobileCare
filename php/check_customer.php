<?php
include 'database_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $criteria = $_POST['criteria'];
    $field = $_POST['field'];

    $sql = "SELECT * FROM customers WHERE $field = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $criteria);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $customer = $result->fetch_assoc();
        echo json_encode($customer);
    } else {
        echo json_encode([]);
    }

    $stmt->close();
    $conn->close();
}