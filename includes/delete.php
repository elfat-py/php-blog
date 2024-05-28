<?php

    chdir('..');
    require_once 'includes/header.php';

?>

<?php
if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
    $id = $_GET['user_ID'];
    $sql = "DELETE FROM `user` WHERE user_ID = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: ../user?msg=Data deleted successfully");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}else{
    header("Location: /user.php?msg=You are not admin not allowed!");
}