<?php
require_once 'includes/header.php';
// Example query to get some data
$sql = "SELECT * FROM users"; // Replace with your actual query
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h2>Admin Queries</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Name</th><th>Value</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row['ID'] . "</td><td>" . $row['USERNAME'] . "</td><td>" . $row['PASSWORD'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Error retrieving data: " . mysqli_error($conn);
}

mysqli_close($conn);
?>