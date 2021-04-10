<?php
//   <!--Created by Nathaniel Kumar @ GCU 2021 -->
// this allows to remove a user from the locker in the main app
require "../DBConn.con.php";

//Messager code
$file = basename(__FILE__, '.php');
require "../messager.con.php";
$message = new messager();


session_start();
if (isset($_SESSION["sessionID"])) {
    $id = $_GET['id'];
    $AvalableStatus = 0;
    $noUser = 0;

    $message->newInfoMessage($file, "UserID: " . $userID . " is removing locker " . $id . " from their account");

    $sqlquerry = "UPDATE Lockers SET Vacant= ?,User= ? WHERE Label = ?";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sqlquerry)) {
        header("Location: ../../views/login.php?err=sql");
        $message->newAlertMessage($file, "SQL HAS NO CONNECTION! CHECK DB INFO!");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "iis", $AvalableStatus, $noUser, $id);
        mysqli_stmt_execute($stmt);
        $message->newInfoMessage($file, "UserID: " . $userID . " has SUCESSFULLY removed locker " . $id . " from their account");
        header("Location: ../../views/lockers.php");
        exit();
    }
} else {
    session_unset();
    session_destroy();
    $message->newAlertMessage($file, "A USER ACCESSED A PERMISSION FILE WITHOUT A SESSION STARTED! REDIRECTING USER...");
    header("Location: ../index.php");
    exit();
}
