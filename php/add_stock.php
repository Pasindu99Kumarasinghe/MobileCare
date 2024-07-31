<?php
include 'database_connection.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST['item'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $quantity = $_POST['quantity'];

    $stmt = $conn->prepare("INSERT INTO stock (item, brand, model, quantity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $item, $brand, $model, $quantity);

    if ($stmt->execute()) {
        $response['status'] = 'success';
        $response['message'] = 'Stock added successfully';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
?>
