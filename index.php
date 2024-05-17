<?php

require_once 'includes/database.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Hello, world!</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="" />
</head>
<body>
<h1>Hello there</h1>
<?php

// Performing query
$sql = "SELECT * FROM USERS"; // Adjust table name if necessary
$result = mysqli_query($conn, $sql); // It returns here some weird error as if it has been closed

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
</body>
</html>
