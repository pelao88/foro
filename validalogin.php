<?php 
	session_start();

	include("dbconn.php");

	$username = $_POST['usuario'];
	$userpass = $_POST['password'];

	$result = mysqli_query($con, "SELECT nombre_usuario, password FROM usuarios WHERE nombre_usuario = '".$username."' AND password = '".$userpass."'");

	if(mysqli_num_rows($result) != 0){
		$_SESSION['usuario'] = $username;
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}else{
		header("Location: ".$_SERVER['HTTP_REFERER']."?status=login_fail");
	}
 ?>