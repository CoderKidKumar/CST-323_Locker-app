<?php
//   <!--Created by Nathaniel Kumar @ GCU 2021 -->
//login the user

//Messager code
$file = basename(__FILE__, '.php');
require "messager.con.php";
$message = new messager();


if (isset($_POST['login_submit'])) {
    require "DBConn.con.php";

    $message->newInfoMessage($file, "A user is logging in...");

    $mail = $_POST['mail'];
    $passkey = $_POST['passkey'];

    if (empty($mail) || empty($passkey)) {
        header("Location: ../views/login.php?err=null");
        $message->newNoticeMessage($file, "A user tried to login with empty fields, returning user to login page with error");
        exit();
    } else {
        $sql = "SELECT * FROM Visitors WHERE `Mail`=?";
        $stmt = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../views/login.php?err=sql");
            $message->newAlertMessage($file, "SQL HAS NO CONNECTION! CHECK DB INFO!");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $mail);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $passCheck = password_verify($passkey, $row["Lock_key"]);
                if ($passCheck == false) {
                    $message->newNoticeMessage($file, "A user tried to login with wrong password, returning user to login page with error");
                    header("Location: ../views/login.php?err=wrongpass");
                    exit();
                } else if ($passCheck == true) {
                    session_start();
                    $_SESSION["sessionID"] = $row["ID"];
                    $_SESSION["sessionName"] = $row["Name"];
                    $message->newInfoMessage($file, "UserID: " . $_SESSION["sessionID"] . " has logged in sucessfully");

                    header("Location: ../views/lockers.php");
                    exit();
                }
            } else {
                $message->newNoticeMessage($file, "A user tried to login with wrong creditials, returning user to login page with error");
                header("Location: ../views/login.php?err=nouser");
                exit();
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
} else {
    $message->newAlertMessage($file, "A USER ACCESSED LOGIN THROUGH OTHER MEANS! REDIRECTING USER...");
    header("Location: ../views/login.php");
    exit();
}
