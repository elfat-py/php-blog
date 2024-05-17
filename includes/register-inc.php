<?php
if (isset($_POST['submit'])) {
    require 'database.php';
    if (empty($_POST['username'])) {
        echo 'The username field is required.';
    }
     elseif (empty($_POST['email'])) {
         echo 'The email field is required.';
     }
    elseif (empty($_POST['password'])) {
         echo 'The  field is required.';
     }
    elseif (empty($_POST['password'])) {
         echo 'The password field is required.';
     }
    elseif (empty($_POST['password'])) {
        echo 'The password field is required.';
    } else {
        // Processing form data goes here
        echo 'We can add it to database now';
    }
}
?>