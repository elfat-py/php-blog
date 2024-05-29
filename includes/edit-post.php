<?php
 //require_once 'includes/header.php';
//?>
<!---->
<?php
//$user_posts = $_SESSION['post_of_user'];
//$post_id = $_GET['post_ID'];
//$user_id = $_SESSION['user_ID'];
//$username = $_SESSION['sessionUser'];
//
//// Check if the post ID is in the user's posts
//if (in_array($post_id, $user_posts)) {
//
//    // SQL query to fetch post details
//    $sql = "SELECT title, body FROM post WHERE post_ID = ? AND author_ID = ?";
//    $stmt = mysqli_stmt_init($conn);
//
//    if (mysqli_stmt_prepare($stmt, $sql)) {
//        mysqli_stmt_bind_param($stmt, "ii", $post_id, $user_id);
//        mysqli_stmt_execute($stmt);
//
//        // Get the result
//        $result = mysqli_stmt_get_result($stmt);
//
//        // Fetch the row
//        if ($row = mysqli_fetch_assoc($result)) {
//            ?>
<!--            <div class="container">-->
<!--                <div class="text-center mb-4">-->
<!--                    <h3>Edit Blog Post</h3>-->
<!--                    <p class="text-muted">Complete the fields to edit the blog post!</p>-->
<!--                </div>-->
<!--                <div class="container d-flex justify-content-center">-->
<!--                    <form action="" method="post" style="width:50vw; min-width:300px;">-->
<!--                        <div class="col text-center">-->
<!--                            <div class="row justify-content-center">-->
<!--                                <div class="col">-->
<!--                                    <label class="form-label">Blog Title:</label>-->
<!--                                    <input type="text" class="form-control" name="title" placeholder="A trip in Antarctica" value="--><?php //echo $row['title'] ?><!--" required>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="row">-->
<!--                                <div class="col">-->
<!--                                    <label class="form-label">Body of Blog Post:</label>-->
<!--                                    <textarea class="form-control" name="body" placeholder="It all started with a dream...">--><?php //echo $row['body'] ?><!--</textarea>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="mt-3 text-center">-->
<!--                            <button type="submit" class="btn btn-success" name="submit">Save</button>-->
<!--                            <a href="../user.php" class="btn btn-danger">Cancel</a>-->
<!--                        </div>-->
<!--                        <input type="hidden" name="post_ID" value="--><?php //echo $post_id; ?><!--">-->
<!--                    </form>-->
<!--                </div>-->
<!--            </div>-->
<!--            --><?php
//        } else {
//            echo "<p class='text-center text-danger'>Post not found or you don't have permission to edit this post.</p>";
//        }
//    } else {
//        echo "<p class='text-center text-danger'>SQL error: " . mysqli_error($conn) . "</p>";
//    }
//} else {
//    echo "<p class='text-center text-danger'>Invalid post ID or you don't have permission to edit this post.</p>";
//}
//?>
<!---->
<?php
//if (isset($_POST['submit'])) {
//    $title = $_POST['title'];
//    $body = $_POST['body'];
//    $post_id = $_POST['post_ID'];
//    $user_id = $_SESSION['user_ID'];
//
//    // Prepare the SQL statement with placeholders
//    $sql = "UPDATE post SET title = ?, body = ?, created = ? WHERE post_ID = ? AND author_ID = ?";
//    $stmt2 = mysqli_stmt_init($conn);
//
//    // Check if the prepared statement can be initialized
//    if (!mysqli_stmt_prepare($stmt2, $sql)) {
//        header('Location: ../user.php?error=sqlerror');
//        exit();
//    } else {
//        // Set the current date and time
//        $currentDateTime = date('Y-m-d H:i:s');
//
//        // Bind the parameters to the SQL statement
//        mysqli_stmt_bind_param($stmt2, 'sssii', $title, $body, $currentDateTime, $post_id, $user_id);
//
//        // Execute the statement
//        if (mysqli_stmt_execute($stmt2)) {
//            header('Location: ../user.php?msg=Record updated successfully');
//        } else {
//            echo "Failed: " . mysqli_stmt_error($stmt2);
//        }
//
//        // Close the statement
//        mysqli_stmt_close($stmt2);
//    }
//
//    // Close the connection
//    mysqli_close($conn);
//} else {
//    // Uncomment the following line if you want to redirect when the form is not submitted
//    // header('Location: ../user.php');
//    // exit();
//}
//?>
<?php
//require_once 'includes/footer.php';
//?>



<?php
chdir('..');
require_once 'includes/header.php';

// Start output buffering
ob_start();

$user_posts = $_SESSION['post_of_user'];
$post_id = $_GET['post_ID'];
$user_id = $_SESSION['user_ID'];
$username = $_SESSION['sessionUser'];

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $post_id = $_POST['post_ID'];
    $user_id = $_SESSION['user_ID'];

    // Prepare the SQL statement with placeholders
    $sql = "UPDATE post SET title = ?, body = ?, created = ? WHERE post_ID = ? AND author_ID = ?";
    $stmt2 = mysqli_stmt_init($conn);

    // Check if the prepared statement can be initialized
    if (!mysqli_stmt_prepare($stmt2, $sql)) {
        header('Location: ../user.php?error=sqlerror');
        exit();
    } else {
        // Set the current date and time
        $currentDateTime = date('Y-m-d H:i:s');

        // Bind the parameters to the SQL statement
        mysqli_stmt_bind_param($stmt2, 'sssii', $title, $body, $currentDateTime, $post_id, $user_id);

        // Execute the statement
        if (mysqli_stmt_execute($stmt2)) {
            header('Location: ../user.php?msg=Record updated successfully');
            exit();
        } else {
            echo "Failed: " . mysqli_stmt_error($stmt2);
        }

        // Close the statement
        mysqli_stmt_close($stmt2);
    }

    // Close the connection
    mysqli_close($conn);
} else {
    // Fetch and display the post for editing
    if (in_array($post_id, $user_posts)) {
        // SQL query to fetch post details
        $sql = "SELECT title, body FROM post WHERE post_ID = ? AND author_ID = ?";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ii", $post_id, $user_id);
            mysqli_stmt_execute($stmt);

            // Get the result
            $result = mysqli_stmt_get_result($stmt);

            // Fetch the row
            if ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="container">
                    <div class="text-center mb-4">
                        <h3>Edit Blog Post</h3>
                        <p class="text-muted">Complete the fields to edit the blog post!</p>
                    </div>
                    <div class="container d-flex justify-content-center p-4">
                        <form action="" method="post" style="width:50vw; min-width:300px;">
                            <div class="col text-center m-4 p-1">
                                <div class="row justify-content-center">
                                    <div class="col">
                                        <label class="form-label">Blog Title:</label>
                                        <input type="text" class="form-control" name="title" placeholder="A trip in Antarctica" value="<?php echo $row['title'] ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label">Body of Blog Post:</label>
                                        <textarea style="height: 98%" class="form-control" name="body" placeholder="It all started with a dream..."><?php echo $row['body'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 text-center">
                                <button type="submit" class="btn btn-success" name="submit">Save</button>
                                <a href="../user.php" class="btn btn-danger">Cancel</a>
                            </div>
                            <input type="hidden" name="post_ID" value="<?php echo $post_id; ?>">
                        </form>
                    </div>
                </div>
                <?php
            } else {
                echo "<p class='text-center text-danger'>Post not found or you don't have permission to edit this post.</p>";
            }
        } else {
            echo "<p class='text-center text-danger'>SQL error: " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<p class='text-center text-danger'>Invalid post ID or you don't have permission to edit this post.</p>";
    }
}

// End output buffering and send output
ob_end_flush();
?>

<?php
require_once 'includes/footer.php';
?>

