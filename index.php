<?php
    require_once 'includes/header.php';
?>

<h1>Hello and welcome to my website</h1>


<?php
if (isset($_SESSION['sessionId'])) {
        echo "You are logged in !";
}
else{
    echo "Home!";
}

?>
<?php
    require_once 'includes/footer.php';
?>