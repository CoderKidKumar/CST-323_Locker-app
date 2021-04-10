<?php
//  <!--Created by Nathaniel Kumar @ GCU 2021 -->
//logout the user

//Messager code
$file = basename(__FILE__, '.php');
require "messager.con.php";
$message = new messager();


session_start();
$message->newInfoMessage($file, "UserID: " . $_SESSION["sessionID"] . " is logging out.");
session_unset();
session_destroy();
header("Location: ../index.php");
exit();
