<?php
    require_once 'includes/header.php';

?>

<?php
$id = $_GET["user_ID"];
$sql = "DELETE FROM `user` WHERE id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: index.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}

