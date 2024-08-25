<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "audre";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve and sanitize form inputs
$name = mysqli_real_escape_string($conn, $_POST['name']);
$lastname = mysqli_real_escape_string($conn, $_POST['Lastname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['psw']);
$confirm_password = mysqli_real_escape_string($conn, $_POST['psw-repeat']);

// Check if passwords match
if ($password !== $confirm_password) {
    echo "Passwords do not match!";
    exit();
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user into database
$sql = "INSERT INTO users (name, lastname, email, password) VALUES ('$name', '$lastname', '$email', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
