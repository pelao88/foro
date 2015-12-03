<?php 
	include("dbconn.php");


	$newuser = $_POST["usuario"];
	$newpass = $_POST["password"];
	
	$insert = mysqli_query($con, "INSERT INTO usuarios (nombre_usuario, password) VALUES ('".$newuser."', '".$newpass."');");

	if ($insert) {
		header("location: /sisforo/index.php?status=reg_success");
	} else {
		echo("Error description: " . mysqli_error($insert));
	}
 ?>