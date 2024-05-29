<?php
chdir('..');

require_once 'includes/header.php';
?>

<div class="container">
    <div class="text-center mb-4">
        <h3>Add New User</h3>
        <p class="text-muted">Complete the form below to add a new user</p>
    </div>

    <div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Full Name:</label>
                    <input type="text" class="form-control" name="full-name" placeholder="John Smith">
                </div>

                <div class="col">
                    <label class="form-label">Username:</label>
                    <input type="text" class="form-control" name="username" placeholder="JohnSmith12">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-9">
                    <label class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" placeholder="name@example.com">
                </div>
                <div class="col-sm-3">
                    <label class="form-label">Age:</label>
                    <input type="text" class="form-control" name="age" placeholder="21">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Password:</label>
                    <input type="text" class="form-control" name="password" placeholder="m43%dafd&&">
                </div>

                <div class="col">
                    <label class="form-label">Confirm password:</label>
                    <input type="text" class="form-control" name="confirm-pass" placeholder="m43%dafd&&">
                </div>
            </div>

            <div class="form-group mb-3">
                <label>Admin privileges:</label>
                &nbsp;
                <input type="radio" class="form-check-input" name="isAdmin" id="YesAdm" value="Yes">
                <label for="YesAdm" class="form-input-label">Yes</label>
                &nbsp;
                <input type="radio" class="form-check-input" name="isAdmin" id="NoAdm" value="No">
                <label for="NoAdm" class="form-input-label">No</label>
            </div>

            <div>
                <button type="submit" class="btn btn-success" name="submit">Save</button>
                <a href="index.php" class="btn btn-danger">Cancel</a>
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
        }elseif ($_POST['isAdmin'] == 'No'){
            $role = 0;
        }else{
            header('Location: ../add-new.php?error=chooseadmprivilige&username=' . $username);
            exit();
        }

        $sql = 'SELECT username FROM user WHERE username=?';
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header('Location: ../add-new.php?error=sqlerror&username1=' . $username);
        } else {
            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $row_count = mysqli_stmt_num_rows($stmt);

            if ($row_count > 0) {
                header('Location: ../add-new.php?error=usernametaken&username=' . $username);
                exit();
            } else {
                $sql = "INSERT INTO user(user_full_name, username, email, age, password, role) VALUES (?, ?, ?, ?, ?, ?)";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    header("Location: admin.php?msg=New record created successfully");
                } else {
                    echo "Failed: " . mysqli_error($conn);
                }
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header('Location: ../add-new.php?error=sqlerror&username=' . $username);
                    exit();
                } else {
                    $hashedPass = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, 'sssisi', $user_full_name, $username, $email, $age, $hashedPass, $role);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);

                    header('Location: admin.php?success=registered&username=' . $username);
                    exit();
                }
            }
        }
    }
}
?>

<?php
require_once 'includes/footer.php';
?>
