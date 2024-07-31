<?php
include 'database_connection.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST['item'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $quantity = $_POST['quantity'];

    $stmt = $conn->prepare("SELECT quantity FROM stock WHERE item = ? AND brand = ? AND model = ?");
    $stmt->bind_param("sss", $item, $brand, $model);
    $stmt->execute();
    $stmt->bind_result($current_quantity);
    $stmt->fetch();
    $stmt->close();

    if ($current_quantity >= $quantity) {
        $new_quantity = $current_quantity - $quantity;
        if ($new_quantity == 0) {
            $stmt = $conn->prepare("DELETE FROM stock WHERE item = ? AND brand = ? AND model = ?");
            $stmt->bind_param("sss", $item, $brand, $model);
        } else {
            $stmt = $conn->prepare("UPDATE stock SET quantity = ? WHERE item = ? AND brand = ? AND model = ?");
            $stmt->bind_param("isss", $new_quantity, $item, $brand, $model);
        }

        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Stock deleted successfully';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error: ' . $stmt->error;
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error: Not enough stock to delete';
    }

    $stmt->close();
    $conn->close();
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
?>
