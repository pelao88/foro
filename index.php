<?php 
	include('layout_manager.php');
	include('content_function.php');
 ?>
<html>
<head><title>Foro PHP</title></head>
<link rel="stylesheet" type="text/css" href="/sisForo/styles/main.css">	
<body>
	<div class="pane">
		<div class="header"><h1><a href="/foro">PHP y MySQL FORO</a></h1></div>
		<div class="loginpane">
			<?php
				session_start();
				if (isset($_SESSION['usuario'])){
					logout();
				} else {
					if (isset($_GET['status'])){
						if ($_GET['status'] == 'reg_success') {
							echo "<h1 style='color: green;'>nuevo usuario creado satisfactoriamente</h1>";
						}else if ($_GET['status'] == 'login_fail') {
							echo "<h1 style='color: red;'>credenciales invalidas!</h1>";
						}
					}
					loginform();
				}
			?>
		</div>
		<div class="forumdesc">
			<p>Este es un foro de prueba</p>
		</div>
		<div class="content">
			<?php dispcategorias(); ?>
		</div>
	</div>
</body>
</html>