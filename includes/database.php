<?php
//
//// Database credentials
//$dbHost = "localhost:3307"; //The connection should be specified if the port has been chnaged by default it will check port 3306
//$dbUser = "root";
//$dbPass = ""; // Leave this empty if there's no password
//$dbName = "store_database";
//
//// Create connection
//$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
//
//// Check connection
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//} else {
//    echo "Connected successfully";
//}
//
//// Close connection (optional, PHP closes connections automatically at the end of script execution)
//$conn->close();
//
//
//?>
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

// Performing query
$sql = "SELECT * FROM USERS"; // Adjust table name if necessary
$result = mysqli_query($conn, $sql);

// Checking for errors in query execution
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Displaying results
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row['USERNAME'] . '<br>'; // Adjust column name if necessary
    }
} else {
    echo "No results found";
}

// Free result set
mysqli_free_result($result);

// Close connection
$conn->close();
?>
