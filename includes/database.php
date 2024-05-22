<?php
// Establishing connection
$dbHost = "localhost:3307";
$dbUser = "root";
$dbPass = ""; // Leave this empty if there's no password
$dbName = "blog_db";

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Checking connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//
//
//$sql = "INSERT INTO user(user_full_name, username, email, age, password, role) VALUES ('eli', 'elfat32', 'elfat@gmail.com', 20, '20dfjadk', 1)";
////mysqli_stmt_bind_param($stmt, 'sssisi', 'eli', 'elfat', 'elfat@gmail.com', 20, '20dfjadk', 1);
//
//
//if ($conn->query($sql) === TRUE) {
//  echo "New record created successfully";
//} else {
//  echo "Error: " . $sql . "<br>" . $conn->error;
//}
//
//$conn->close();
?>
