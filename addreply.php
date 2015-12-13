<?php 
	session_start();
	
	include('dbconn.php');

	$comentario = nl2br(addslashes($_POST['comentario']));
	$cid	 	= $_GET['cid'];
	$scid	 	= $_GET['scid'];
	$tid	 	= $_GET['tid'];

	$insert = mysqli_query($con, "INSERT INTO replies (id_categoria,id_subcategoria,id_topico,autor,comentario, fecha_posteo)
								  VALUES('".$cid."','".$scid."','".$tid."','".$_SESSION['usuario']."','".$comentario."',NOW());");

	if($insert){
		header("Location: /sisForo/vertopico.php??cid=".$cid."&scid=".$scid."&tid="$tid."");
	}

?>