
include 'database_connection.php';

// Retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];

// Sanitize input
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

// Hash password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Insert user into database
$query = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
if (mysqli_query($conn, $query)) {
    echo "Registration successful";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
