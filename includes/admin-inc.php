<?php
if (isset($_POST['submit'])) {
    require 'database.php';

    $username = $_POST['username1'];
    $password = $_POST['password1'];

    if (empty($username) || empty($password)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    }else{
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        } else{
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $passCheck = password_verify($password, $row['PASSWORD']);

                echo $passCheck . 'THe result';

                if ($passCheck == false) {
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                }elseif ($passCheck == true) {
                    $_SESSION['sessionId'] = $row['ID'];
                    $_SESSION['sessionUser'] = $row['USERNAME'];

                    if ($row['role' == 1]){
                        $_SESSION['sessionRole'] = 'admin';
                    }
//                    $_SESSION['sessionRole'] = $row['role' == 1];
                    header("Location: ../admin.php?success=loginsuccess");
                    exit();
                }else{
                    header("Location: ../index.php?error=nouser");
                }
            }else{
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }
    }
}else{
    header('Location: ../index.php?error=accessforbidden=');
    exit();

}
?>

