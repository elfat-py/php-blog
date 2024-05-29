<!-- I don't think i should include any privacy related issues here so everyone can check this page -->
<?php
chdir('..');

require_once 'includes/header.php';
?>

<!-- Meaby the user can select here his blog posts and overall blog posts -->
    <div class="container text-center">
        <div class="row align-items-center">
            <div class="col">
                <a href="../all_posts.php">All posts</a>
            </div>
            <div class="col">
                <a href="/admin-post.php" target="_blank">Admin posts</a>
            </div>
            <div class="col">
                <a href="../user.php">My blog</a>
            </div>
        </div>
    </div>

<!--The blog section of the user -->
<div class="card mb-3">
    <ul class="list-group">
        <li class="list-group-item active text-center" aria-current="true">Admin blogs</li>
        <div class="list-group-item">
            <?php
            $sql = ("SELECT post.title, post.created, post.body, post.post_ID, user.username, user.role FROM post JOIN user ON post.author_ID = user.user_ID WHERE user.role=1");
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row text-end">
                            <div class="col">
                                <h5 class="card-title text-end m-0 fw-light"><?php echo 'admin: ' .$row['username'] ?></h5>
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

<?php
require_once 'includes/footer.php';
?>


<?php
function check_role($role){
    if ($role  == 1){
        return 'by: admin';
    }
}



