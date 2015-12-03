<?php  

	include('dbconn.php');
	$select = mysqli_query($con, "select * from categorias");
	while ($row = mysqli_fetch_assoc($select)) {
		echo "<h1>".$row['titulo_categoria']."</h1>";
	}

?>