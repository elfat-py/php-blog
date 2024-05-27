<?php
chdir('..');

require_once 'includes/header.php';

$id = $_GET['user_ID'];


$sql = "SELECT * FROM `user` WHERE user_ID = $id LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


?>

<div class="container">
    <div class="text-center mb-4">
        <h3>Add New User</h3>
        <p class="text-muted">Complete the form below to edit the user!</p>
    </div>

    <div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Full Name:</label>
                    <input type="text" class="form-control" name="full-name"
                           value="<?php
                           if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
                               echo $row['user_full_name'];
                           }
                           ?>">
                </div>

                <div class="col">
                    <label class="form-label">Username:</label>
                    <input type="text" class="form-control" name="username" value="<?php
                    if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
                        echo $row['username'];
                    }
                    ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-9">
                    <label class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" value="<?php
                    if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
                        echo $row['email'];
                    }
                    ?>">
                </div>
                <div class="col-sm-3">
                    <label class="form-label">Age:</label>
                    <input type="text" class="form-control" name="age" value="<?php
                    if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
                        echo $row['age'];
                    }
                    ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Password:</label>
                    <input type="text" class="form-control" name="password" placeholder="Cannot receive password!">
                </div>

                <div class="col">
                    <label class="form-label">Confirm password:</label>
                    <input type="text" class="form-control" name="confirm-pass" placeholder="Confirm new password!">
                </div>
            </div>

            <div class="form-group mb-3">
                <label>Admin privileges:</label>
                &nbsp;
                <input type="radio" class="form-check-input" name="isAdmin" id="YesAdm"
                       value="Yes" <?php
                if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
                    echo ($row["role"] == '1') ? "checked" : "";
                }
                ?>>
                <label for="YesAdm" class="form-input-label">Yes</label>
                &nbsp;
                <input type="radio" class="form-check-input" name="isAdmin" id="NoAdm"
                       value="No" <?php
                if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
                    echo ($row["role"] == '0') ? "checked" : "";
                }
                ?>>
                <label for="NoAdm" class="form-input-label">No</label>
            </div>

            <div>
                <button type="submit" class="btn btn-success" name="submit">Save</button>
                <a href="admin.php" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php
if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
    if (isset($_POST['submit'])) {

        $user_full_name = $_POST['full-name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $password = $_POST['password'];
        $passwordConfirm = $_POST['confirm-pass'];
        if ($_POST['isAdmin'] == 'Yes') {
            $role = 1;
        } elseif ($_POST['isAdmin'] == 'No') {
            $role = 0;
        } else {
            header('Location: ../add-new.php?error=chooseadmprivilige&username=' . $username);
            exit();
        }
        if ($password == $passwordConfirm) {
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE `user` SET `user_full_name`='$user_full_name',`username`='$username',`email`='$email',`age`='$age',`password`='$hashedPass',`role`='$role' WHERE user_ID = $id";
            $result = mysqli_query($conn, $sql);
        }
        if ($result) {
            header("Location: ..admin.php?msg=Data changed succesfully");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }
}
?>

<?php
require_once 'includes/footer.php';
?>
