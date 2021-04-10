<?php
	//  <!--Created by Nathaniel Kumar @ GCU 2021 -->
	//connect to the database
	$servername = "lyn7gfxo996yjjco.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
	$DBuser = "xztyzzd0q3647sig";
	$DBpass = "dpxjf2500bg7kc2x";
	$DBname = "rry2dq2j64uk6ug1";
	$DBport = "3306";
	$success = mysqli_connect(
	    $servername,
	    $DBuser,
	    $DBpass,
	    $DBname,
	    $DBport
	);
	if (!$success) {
	    die("Connection to DB failed: " . mysqli_connect_error());
	} else {
	    $connection = $success;
	}
 

