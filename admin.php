<?php
    require_once 'includes/header.php';
?>
<!--For tomorrow try to finialize the admin page where he will be able to see how many posts a uses has made the email dhe password as well as will -->
<!--be able to delete edit etc the content on users end-->
<?php
if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
    echo '<h1>Displaying some data for the admin</h1>';
    echo '<br>';
}
else{
    echo '<h1>You are not admin</h1>';
}
?>

<div class="container text-center gap-0 row-gap-0">
    <a href="includes/add-new.php"><button type="button" class="btn btn-primary d-flex justify-content-end">Add new user</button></a>


    <div class="row align-items-start d-flex align-items-start mb-2 bg-body-tertiary gap-0 row-gap-0">
        <div class="col-1 border border-light-subtle mb-2 bg-black text-white">
            ID
        </div>
        <div class="col-2 border border-light-subtle mb-2 bg-black text-white">
            Username
        </div>
        <div class="col-2 border border-light-subtle mb-2 bg-black text-white">
            Full Name
        </div>
        <div class="col-3 border border-light-subtle mb-2 bg-black text-white">
            Email
        </div>
        <div class="col-1 border border-light-subtle mb-2 bg-black text-white">
            Age
        </div>
        <div class="col-1 border border-light-subtle mb-2 bg-black text-white">
            Role
        </div>
        <div class="col-2 border border-light-subtle bg-secondary-subtle text-secondary-emphasisk-emphasis">
            Action
        </div>

    </div> <!-- END FIRST MAIN ROW-->


    <div class="row align-items-start d-flex align-items-start mb-2 bg-body-tertiary gap-0 row-gap-0">
        <?php
            $sql = "SELECT * FROM user"; // Replace with your actual query
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $user_Id = $row['user_ID'];
                $username = $row['username'];
                $user_full_name = $row['user_full_name'];
                $email = $row['email'];
                $age = $row['age'];
                $role = $row['role'];
        ?>
        <div class="col-1 border border-light-subtle mb-2 bg-black text-white">
            <?php
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
                echo $user_Id;
            } else {
                echo 'admin-content';
            }
            ?>
        </div>
        <div class="col-2 border border-light-subtle mb-2 bg-black text-white">
            <?php
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
                echo $username;
            } else {
                echo 'admin-content';
            }
            ?>
        </div>
        <div class="col-2 border border-light-subtle mb-2 bg-black text-white">
            <?php
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
                echo $user_full_name;
            } else {
                echo 'admin-content';
            }
            ?>
        </div>
        <div class="col-3 border border-light-subtle mb-2 bg-black text-white">
            <?php
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
                echo $email;
            } else {
                echo 'admin-content';
            }
            ?>
        </div>
        <div class="col-1 border border-light-subtle mb-2 bg-black text-white">
            <?php
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
                echo $age;
            } else {
                echo 'admin-content';
            }
            ?>
        </div>
        <div class="col-1 border border-light-subtle mb-2 bg-black text-white">
            <?php
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
                echo $role;
            } else {
                echo 'admin-content';
            }
            ?>
        </div>

        <div class="col-1 border border-light-subtle bg-dark-subtle text-dark-emphasis">
            <a href="includes/edit.php">Edit</a>
        </div>
        <div class="col-1 border border-light-subtle bg-dark-subtle text-dark-emphasis">
<!--            <a href="includes/edit.php">Delete</a>-->
            <a href="delete.php?user_ID=<?php echo $user_Id; ?>" class="link-dark">Delete<i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
        </div>

        <!-- END OF DATA ROW-->

        <?php
            } //Closing tag for the while loop
        ?>
    </div>

<?php
//if (isset($))
//$id = $_GET["user_ID"];
//$sql = "DELETE FROM `user` WHERE id = $id";
//$result = mysqli_query($conn, $sql);



require_once 'includes/footer.php';
//?>
