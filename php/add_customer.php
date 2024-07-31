<?php
include 'database_connection.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerName = $_POST['customerName'];
    $idNumber = $_POST['idNumber'];
    $contactNumber = $_POST['contactNumber'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $purchasedItems = $_POST['purchasedItems'];
    $billValue = $_POST['billValue'];

    // Prepare an insert statement
    $sql = "INSERT INTO customers (customerName, idNumber, contactNumber, email, address, purchasedItems, billValue) VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssi", $customerName, $idNumber, $contactNumber, $email, $address, $purchasedItems, $billValue);
        
        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Customer added successfully';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error: Could not execute the query: ' . $conn->error;
        }

        // Close statement
        $stmt->close();
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error: Could not prepare the query: ' . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
?>
