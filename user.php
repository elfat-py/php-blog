<?php
require_once 'includes/header.php';

?>

<?php
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    $username = $_SESSION['sessionUser'];
    $age = $_SESSION['age'];
    $email = $_SESSION['email'];
    $fullName = $_SESSION['fullName'];

    echo '<ul class="list-group">';
    echo '<li class="list-group-item active" aria-current="true">Displaying some data for the user</li>';
    echo '<li class="list-group-item">' .'Your full name is: ' .$fullName. '</li>';
    echo '<li class="list-group-item">' .'Your username is: ' .$username. '</li>';
    echo '<li class="list-group-item">' .'Your age is: ' .$age. '</li>';
    echo '<li class="list-group-item">' .'Your email is: ' .$email. '</li>';
    echo '</ul>';


} else {
    echo '<h1>You haven\'t logged in there is no content to show</h1>';
}
?>


<?php
require_once 'includes/footer.php';
?>

