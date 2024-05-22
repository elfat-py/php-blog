<?php
if (isset($_POST['submit'])) {
    require 'database.php';

    $username = $_POST['username1'];
    $password = $_POST['password1'];

    if (empty($username) || empty($password)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    }else{
//        session_start();
//        $_SESSION['sessionId'] = 3 ;
//        $_SESSION['sessionUser'] = $username;
//        header("Location: ../index.php?success=loginsuccess");
//        exit();
//        echo $password;
//        echo $username;
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

//                foreach ($row as $key => $value){
//                    echo $key . ':' . $value . '<br>';
//                }
                $passCheck = password_verify($password, $row['PASSWORD']);

//                echo $passCheck . 'THe result';

                if ($passCheck == false) {
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                }elseif ($passCheck == true) {
                    session_start();
                    $_SESSION['sessionRole'] = $row['role'];

                    if ($_SESSION['sessionRole'] == 1)
                    {
                        $_SESSION['isAdmin'] = true;
                        header("Location: ../admin.php?success=loggedasadmin");
                        exit();
                    }else {
                        $_SESSION['isAdmin'] = false; // Should give value to false otherwise it will show us the content
                        $_SESSION['loggedIn'] = true;
                        $_SESSION['sessionId'] = $row['ID'];
                        $_SESSION['sessionUser'] = $row['USERNAME'];

                        header("Location: ../user.php?success=user.php");
                        exit();
                    }
                }else{
                    header("Location: ../index.php?error=nouser");
                    exit();
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

