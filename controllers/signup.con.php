<?php
//  <!--Created by Nathaniel Kumar @ GCU 2021 -->
//takes the user's info to create a user to the database

//Messager code
$file = basename(__FILE__, '.php');
require "messager.con.php";
$message = new messager();

if (isset($_POST['register_visitor'])) {
    require "DBConn.con.php";

    $message->newInfoMessage($file, "A user is signing up...");

    $visitorName = $_POST["visitor"];
    $mail = $_POST["mail"];
    $phone = $_POST["phone"];
    $password = $_POST["passkey"];

    if (empty($visitorName) || empty($mail) || empty($password)) {
        header("Location: ../views/signup.php?err=null");
        $message->newNoticeMessage($file, "A user tried to sign up with empty fields, returning user to signup page with error");
        exit();
    } else if (strlen($password) <= 6 && strlen($password) >= 12) {
        header("Location: ../views/signup.php?err=length");
        $message->newNoticeMessage($file, "A user tried to sign up with incorrect password length, returning user to signup page with error");
        exit();
    } else {
        $message->newInfoMessage($file, "A user's account is being created...");
        $sql = "SELECT * FROM Visitors WHERE `Mail`=?";
        $stmt = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../views/signup.php?err=sql");
            $message->newAlertMessage($file, "SQL HAS NO CONNECTION! CHECK DB INFO!");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $mail);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($result > 0) {
                header("Location: ../views/signup.php?err=registered");
                $message->newNoticeMessage($file, "A user has created an account with an email that is already been registerd");
                exit();
            } else {
                if (empty($phone)) {
                    $phone = null;
                }
                $sql2 = "INSERT INTO `Visitors`(`Name`, `Mail`, `Phone`, `Lock_key`) VALUES (?,?,?,?)";
                $stmt2 = mysqli_stmt_init($connection);
                if (!mysqli_stmt_prepare($stmt2, $sql2)) {
                    header("Location: ../views/signup.php?err=sql");
                    $message->newAlertMessage($file, "SQL HAS NO CONNECTION! CHECK DB INFO!");
                    exit();
                } else {
                    $hashPass = password_hash($password, PASSWORD_BCRYPT);

                    mysqli_stmt_bind_param($stmt2, "ssss", $visitorName, $mail, $phone, $hashPass);
                    mysqli_stmt_execute($stmt2);
                    header("Location: ../views/login.php?success=login");
                    $message->newInfoMessage($file, "A user has sucessfully signed up.");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmt2);
    mysqli_close($connection);
} else {
    $message->newAlertMessage($file, "A USER ACCESSED SIGNUP THROUGH OTHER MEANS! REDIRECTING USER...");
    header("Location: ../views/signup.php");
    exit();
}
