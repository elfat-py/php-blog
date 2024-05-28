<?php
    chdir('..');
    require_once 'includes/header.php';
?>

<?php

$user_posts = $_SESSION['post_of_user'];
$id = $_GET['post_ID'];
if (in_array($id, $user_posts)) {

    $sql = "DELETE FROM `post` WHERE  post_ID = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: ../user.php?msg=Data deleted successfully");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}else{
    header("Location: ../user.php?msg=You are not allowed to delete this!");
}