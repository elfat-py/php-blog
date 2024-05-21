<?php
    require_once 'includes/header.php';
?>


<form action="includes/register-inc.php" method="post">
    <input name="name" placeholder="Enter full name">

    <input name="username" placeholder="Enter your username">

    <input name="email" type="email" placeholder="Enter e-mail">

    <input name="password" type="password" placeholder="Enter password">

    <input name="password-confirm" type="password" placeholder="Confirm password">

    <button value="Submit" name="submit" >Register</button>
</form>

<?php
    require_once 'includes/footer.php';
?>
