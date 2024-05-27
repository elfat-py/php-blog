<?php
require_once 'includes/header.php';
?>


<?php
function get_user_id($conn, $username)
{
    $sql = "SELECT user_ID FROM user WHERE username = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("SQL error: " . mysqli_error($conn));
        return -1; // This line will never be executed due to die()
    } else {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Check if a row is returned
        if ($row = mysqli_fetch_assoc($result)) {
            mysqli_stmt_close($stmt);
            return $row['user_ID'];
        } else {
            mysqli_stmt_close($stmt);
            return -1;
        }
    }
}

function get_user_post_ids($conn, $username){
    $sql = "SELECT p.post_ID FROM post p JOIN user u ON p.author_ID = u.user_ID WHERE u.username = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("SQL error: " . mysqli_error($conn));
        return -1;
    } else {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "s", $username);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        // Initialize an array to store the IDs
        $post_ids = array();

        // Fetch all rows and store the IDs in the array
        while ($row = mysqli_fetch_assoc($result)) {
            $post_ids[] = $row['post_ID'];
        }

        // Close the statement
        mysqli_stmt_close($stmt);

        // Return the array of post IDs
        return $post_ids;
    }
}
?>

<?php
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    $username = $_SESSION['sessionUser'];
    $age = $_SESSION['age'];
    $email = $_SESSION['email'];
    $fullName = $_SESSION['fullName'];
    $_SESSION['user_ID'] = get_user_id($conn, $username);
    $_SESSION['post_of_user'] = get_user_post_ids($conn, $username);

    echo '<ul class="list-group">';
    echo '<li class="list-group-item active" aria-current="true">Displaying some data for the user</li>';
    echo '<li class="list-group-item">' . 'Your full name is: ' . $fullName . '</li>';
    echo '<li class="list-group-item">' . 'Your username is: ' . $username . '</li>';
    echo '<li class="list-group-item">' . 'Your age is: ' . $age . '</li>';
    echo '<li class="list-group-item">' . 'Your email is: ' . $email . '</li>';
    echo '<li class="list-group-item">' . 'Your user ID is: ' . get_user_id($conn, $username) . '</li>';
    echo '</ul>';




} else {
    echo '<h1>You haven\'t logged in there is no content to show</h1>';
}
?>

    <a href="includes/add-new-post.php">
        <button type="button" class="btn btn-primary d-flex justify-content-end">Add new post</button>
    </a>
<?php

$user_ID = get_user_id($conn, $username);
$sql = "SELECT title, created, body, post_ID FROM post WHERE author_ID = $user_ID"; // Replace with your actual query
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    ?>

    <br>

    <section class="posts-container">
        <article class="post">
            <header class="main-header">
                <div class="header-container">
                    <h1 class="title-post"><?php echo $row['title'] ?></h1>
                    <br>
                    <div class="about-post">by <?php echo $username ?> on <?php echo $row['created'] ?></div>
                    <br>
                </div>
            </header>
            <p class="body-post"><?php echo $row['body'] ?></p>
        </article>

        <div class="col-1 border border-light-subtle bg-dark-subtle text-dark-emphasis">
            <a href="includes/delete-post.php?post_ID=<?php echo $row['post_ID'] ?>" class="link-dark">Delete<i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
        </div>
        <div class="col-1 border border-light-subtle bg-dark-subtle text-dark-emphasis">
            <a href="includes/edit-post.php?post_ID=<?php echo $row['post_ID'] ?>" class="link-dark">Edit<i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
        </div>
    </section>
    <hr>
    <?php
}
?>

<?php
require_once 'includes/footer.php';
?>

