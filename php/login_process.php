<?php
// login_process.php

include 'database_connection.php'; // Include your database connection file

session_start(); // Start a session to manage user state

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitize input
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Check if username exists
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch user data
        $user = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Redirect to home page or dashboard
            header("Location: ../index.html");
            exit();
        } else {
            // Incorrect password
            echo "Invalid username or password";
        }
    } else {
        // Username does not exist
        echo "Invalid username or password";
    }
}

mysqli_close($conn);
