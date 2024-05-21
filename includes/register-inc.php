<?php
if (isset($_POST['submit'])) {
    require 'database.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_conf = $_POST['password-confirm'];
    $email = $_POST['email'];

    if (empty($_POST['username']) || empty($_POST['name']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['password-confirm']))  {
        header('Location: ../register.php?error=emptyfields&username='.$username);
        exit();
    }
     elseif (!preg_match('/^[a-zA-Z0-9]*$/', $_POST['username'])) {
        header('Location: ../register.php?error=invalidusername&username='.$username);
        exit();
    }
    elseif ($password != $password_conf) {
        header('Location: ../register.php?error=passwordsdonotmatch&username='.$username);
        exit();
     }
    elseif (empty($_POST['password-confirm'])) {
         echo 'You should confirm the password.';
    }else{
        $sql = 'SELECT USERNAME FROM USERS WHERE USERNAME=?';
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header('Location: ../register.php?error=sqlerror&username='.$username);
        }else{
            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $row_count = mysqli_stmt_num_rows($stmt);

            if($row_count > 0) {
                header('Location: ../register.php?error=usernametaken&username='.$username);
                exit();
            }else{
                $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)){
                    header('Location: ../register.php?error=sqlerror&username='.$username);
                    exit();
                }else{
                    $hashedPass = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, 'ss', $username, $hashedPass);
                    mysqli_stmt_execute($stmt);
                    header('Location: ../register.php?success=registered&username='.$username);
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>



<!---->
<?php
//if (isset($_POST['submit'])) {
//    require 'database.php';
//
//    $username = $_POST['username'];
//    $password = $_POST['password'];
//
//    if (empty($username) || empty($password )) {
//        header('Location: ../login.php?error=emptyfields');
//        exit();
//    }else{
//        $sql = "SELECT * FROM users WHERE username = ?";
//        $stmt = mysqli_stmt_init($conn);
//
//        if (!mysqli_stmt_prepare($stmt, $sql)) {
//            header('Location: ../login.php?error=sqlerror');
//            exit();
//        }else{
//            mysqli_stmt_bind_param($stmt, "s", $username);
//            mysqli_stmt_execute($stmt);
//            $results = mysqli_stmt_get_result($stmt);
//
//            if($row = mysqli_fetch_assoc($results)){
//                echo $password;
//                echo $row['password'];
//
//                $pass_check = password_verify($password, $row['password']); //This will return a boolean
//
//
//                if($pass_check == false){
//                    header('Location: ../login.php?error=wrongpassword1');
//                    exit();
//                }elseif($pass_check == true){
//                    session_start();
//                    $_SESSION['sessionId'] = $row['id'];
//                    $_SESSION['sessionUser'] = $row['username'];
//                    header('Location: ../login.php?success=loggedIn');
//                    exit();
//                }else{
//                    header('Location: ../login.php?error=wrongpassword2');
//                    exit();
//                }
//            }else{
//                header('Location: ../login.php?error=nouser');
//                exit();
//            }
//        }
//    }
//}else{
//    header('Location: ../login.php?error=accessforbiden&username=');
//    exit();
//}
//?>
