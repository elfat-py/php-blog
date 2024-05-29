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

function get_user_post_ids($conn, $username)
{
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
    ?>
    <!-- Meaby the user can select here his blog posts and overall blog posts -->
    <div class="container text-center">
        <div class="row align-items-center">
            <div class="col">
                <a href="all_posts.php" target="_blank" >All posts</a>
            </div>
            <div class="col">
                admin posts
            </div>
            <div class="col">
                my posts
            </div>
        </div>
    </div>

    <!--The User information section of the user page -->
    <div class="row p-0">
        <div class="col-4 p-0">
            <ul class="list-group">
                <li class="list-group-item bg-info text-dark" aria-current="true">User</li>
                <li class="list-group-item">
                    <label class="text-body-secondary text-decoration-underline">Full name : </label>
                    <label class="fs-6 text-capitalize fw-medium"><?php echo $fullName ?></label>
                </li>
                <li class="list-group-item">
                    <label class="text-body-secondary text-decoration-underline">Username : </label>
                    <label class="fs-6 text-capitalize fw-medium"><?php echo $username ?></label>
                </li>
                <li class="list-group-item">
                    <label class="text-body-secondary text-decoration-underline">Age : </label>
                    <label class="fs-6 text-capitalize fw-medium"><?php echo $age ?></label>
                </li>
                <li class="list-group-item">
                    <label class="text-body-secondary text-decoration-underline">Email : </label>
                    <label class="fs-6 text-capitalize fw-medium"><?php echo $email ?></label>
                </li>
                <li class="list-group-item">
                    <label class="text-body-secondary text-decoration-underline">User ID : </label>
                    <label class="fs-6 text-capitalize fw-medium"><?php echo get_user_id($conn, $username) ?></label>
                <li class="list-group-item">
                    <a href="includes/add-new-post.php">
                        <button type="button" class="btn btn-primary d-flex">Add new post</button>
                    </a>
                </li>
            </ul>
        </div>

        <!--The blog section of the user -->
        <div class="col-8 p-0">
            <ul class="list-group">
                <li class="list-group-item active" aria-current="true">Blog</li>
                <div class="list-group-item">
                    <?php
                    $user_ID = get_user_id($conn, $username);
                    $sql = "SELECT title, created, body, post_ID FROM post WHERE author_ID = $user_ID";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row text-end">
                                    <div class="col">
                                        <a href="includes/delete-post.php?post_ID=<?php echo $row['post_ID'] ?>"
                                           class="btn btn-danger btn-sm">Delete</a>
                                        <a href="includes/edit-post.php?post_ID=<?php echo $row['post_ID'] ?>"
                                           class="btn btn-warning btn-sm">Edit</a>
                                    </div>
                                </div>
                                <h5 class="card-title text-center m-0 fw-light"><?php echo $row['title'] ?></h5>
                                <p class="card-title text-end m-0 fst-italic"><?php echo $row['created'] ?></p>
                                <hr style="width: 50%; margin: auto">
                                <p class="card-text text-center p-4 fw-lighter"><?php echo $row['body'] ?></p>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                </li>
            </ul>
        </div>
    </div>

    <?php

} else {
    echo '<h1>You haven\'t logged in there is no content to show</h1>';
}
?>

<?php
require_once 'includes/footer.php';
?>

