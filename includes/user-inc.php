

<?php



// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Values to check
$provided_user_id = 15;
$provided_username = 'john_doe';

// Query to check if user_ID belongs to username
$sql = "SELECT * FROM user WHERE user_ID = ? AND username = ?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    die("SQL error: " . mysqli_error($conn));
} else {
    mysqli_stmt_bind_param($stmt, "is", $provided_user_id, $provided_username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    // Check if any row is returned
    if (mysqli_stmt_num_rows($stmt) > 0) {
        echo "The user_ID $provided_user_id belongs to the username $provided_username.";
    } else {
        echo "The user_ID $provided_user_id does not belong to the username $provided_username.";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the connection
mysqli_close($conn);
?>
