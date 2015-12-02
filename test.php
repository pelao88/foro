<?php 
	include ('dbconn.php');
	$select = mysqli_query($con, "SELECT * FROM categorias");
	while ($row = mysqli_fetch_assoc($select)) {
		echo "<h1>".$row['titulo_categoria']."</h1>";
	}
 ?>