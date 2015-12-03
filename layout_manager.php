<?php 
	function loginform(){
		echo "<form action='/sisforo/validalogin.php' method='POST'>
			  <p>Username: </p>
				<input type='text' id='usuario' name='usuario'/>
				<p>Password: </p>
				<input type='password' id='password' name='password'/>
				<input type='submit' value='Login'/>
				<button type='button' onclick='location.href=\"/sisforo/registrar.html\";'>Registrar</button>
			  </form>";
	}

	function logout(){
		echo nl2br("<p>Bienvenido ".$_SESSION['usuario']."!</p>
				<form action='/sisforo/logout.php' method='GET'>
				<input type='submit' value='Logout' /></form>");
	}

?>