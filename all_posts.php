<!-- I don't think i should include any privacy related issues here so everyone can check this page -->
<?php
require_once 'includes/header.php';
?>

<!--The blog section of the user -->
<div class="card mb-3">
    <ul class="list-group">
        <li class="list-group-item active text-center" aria-current="true">Blog</li>
        <div class="list-group-item">
            <?php
$sql = ("SELECT post.title, post.created, post.body, post.post_ID, user.username, user.role FROM post JOIN user ON post.author_ID = user.user_ID");

            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row text-end">
                            <div class="col">
                                <h5 class="card-title text-end m-0 fw-light"><?php echo $row['username'] ?></h5>
                                <h5 class="card-title text-start m-0 text-danger fw-light" ><?php echo check_role($row['role']) ?></h5>
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

function check_role($role){
    if ($role  == 1){
        return 'BY: ADMIN';
    }
}
