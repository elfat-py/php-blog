<?php
    require_once 'includes/header.php';
?>

<form action="includes/login-inc.php" method="post">
    <input name="username1" placeholder="Enter username">
    <input name="password1" type="password" placeholder="Enter password">
    <button type="submit" name="submit" >Log in</button>
</form>
    <?php
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'emptyfields') {
            echo '<p>Fill in all fields!</p>';
        } elseif ($_GET['error'] == 'sqlerror') {
            echo '<p>SQL error!</p>';
        } elseif ($_GET['error'] == 'wrongpassword') {
            echo '<p>Wrong password!</p>';
        } elseif ($_GET['error'] == 'nouser') {
            echo '<p>No user found!</p>';
        }
    }
    ?>
<?php
    require_once 'includes/footer.php';
?>
