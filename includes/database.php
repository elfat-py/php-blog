<?php
// Establishing connection
$dbHost = "localhost:3307";
$dbUser = "root";
$dbPass = ""; // Leave this empty if there's no password
$dbName = "store_database";

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Checking connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
