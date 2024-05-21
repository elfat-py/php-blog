<?php
    session_start();
    require_once 'includes/database.php';
    require_once 'includes/register-inc.php';
//    require_once 'includes/login-inc.php';
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
<header>
    <nav>
        <ul>
            <li><a href="index.php" >Home</a></li>
            <li><a href="login.php" >Log in</a></li>
            <li><a href="register.php" >Register</a></li>
        </ul>
    </nav>
</header>