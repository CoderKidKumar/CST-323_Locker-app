<?php
//   <!--Created by Nathaniel Kumar @ GCU 2021 -->
// delete a locker from database
require "../DBConn.con.php";

session_start();
if (isset($_SESSION["sessionID"])) {
    if ($_SESSION["sessionID"] == 1) {
        $id = $_GET['locker'];

        $sql = "DELETE FROM Lockers WHERE Label = ?";
        $stmt = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../../views/login.php?err=sql");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $id);
            mysqli_stmt_execute($stmt);
            header("Location: ../../admin-lock/dashboard.php?success=delete");
            exit();
        }
    } else {
        session_unset();
        session_destroy();
        header("Location: ../index.php");
        exit();
    }
} else {
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit();
}
