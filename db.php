<?php
$servername = "localhost"; // XAMPP default
$username = "root"; // Default username in XAMPP
$password = ""; // Default password in XAMPP
$dbname = "user_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
