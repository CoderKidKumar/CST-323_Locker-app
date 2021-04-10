<?php
//  <!--Created by Nathaniel Kumar @ GCU 2021 -->
//connect to the database
$servername = "cgulockerapp.mysql.database.azure.com";
$DBuser = "azure";
$DBpass = "6#vWHD_$";
$DBname = "localdb";
$success = mysqli_connect(
    $servername,
    $DBuser,
    $DBpass,
    $DBname
);
if (!$success) {
    die("Connection to DB failed: " . mysqli_connect_error());
} else {
    $connection = $success;
}