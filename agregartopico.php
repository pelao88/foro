<?php 
	session_start();
	
	include('dbconn.php');

	$topico = addslashes($_POST['topico']);
	$contenido = nl2br(addslashes($_POST['contenido']));
	$cid = $_GET['cid'];
	$scid = $_GET['scid'];

	$insert = mysqli_query($con, "INSERT INTO topicos (id_categorias, id_subcat, autor, titulo, contenido, fecha_posteo)
								  VALUES ('".$cid."', '".$scid."', '".$_SESSION['usuario']."', '".$topico."', '".$contenido."', NOW());");

	if ($insert){
		header("Location: /sisForo/topicos.php?cid=".$cid."&scid=".$scid."");
	}
 ?>