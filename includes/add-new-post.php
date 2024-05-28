<?php
chdir('..');

require_once 'includes/header.php';
//require_once 'includes/style.css';
//require_once 'includes/style_add_post.css';
?>


<div class="container">
  <h1>:: New Blog</h1>
  <form method="post">
    <label class="form-label" for="title">Title</label>
    <input name="title" id="title" class="form-input" placeholder="Enter your title here" required>
      <br>
    <label class="form-label" for="body">Body</label>
    <textarea name="body" class="form-textarea" id="body" placeholder="Enter your blog content here"></textarea>
    <input name="submit" type="submit" class="form-submit safe" value="Save">
  </form>
</div>
<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $body = $_POST['body'];


    $sql = "INSERT INTO post(author_ID, created, title, body) VALUES (?, ?, ?, ?)";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: ..add-new-post.php?msg=New record created successfully");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ../add-new.php?error=sqlerror&username=' . $_SESSION['sessionUser'] );
        exit();
    } else {
        $currentDateTime = date('Y-m-d H:i:s');
        $user_id = 17;

        mysqli_stmt_bind_param($stmt, 'isss', $_SESSION['user_ID'], $currentDateTime, $title, $body);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        header('Location: ../user.php?success=postuploaded&username=' . $_SESSION['sessionUser'] );
        exit();
    }



}

?>

<?php
require_once 'includes/footer.php';
?>
