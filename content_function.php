<?php 
	function dispcategorias(){
		include('dbconn.php');

		$select = mysqli_query($con, "SELECT * FROM categorias");

		while ($row = mysqli_fetch_assoc($select)){
			echo "<table class='categorias-tabla'>";
			echo "<tr><td class='categoria-main' colspan='2'>".$row['titulo_categoria']."</td></tr>";
			dispsubcategorias($row['id_categorias']);
			echo "</table>";
		}
	}

	function dispsubcategorias($parent_id){
		include('dbconn.php');

		$select = mysqli_query($con, "SELECT id_categorias, id_subcat, subcategoria_titulo, subcategoria_desc FROM categorias, subcategorias
									  WHERE ($parent_id = categorias.id_categorias) AND ($parent_id = subcategorias.parent_id)");
		echo "<tr><th width='90%'>Categorias</th><th width='10%'>Topicos</th></tr>";
		while ($row = mysqli_fetch_assoc($select)){
			echo "<tr><td class='categoria-titulo'><a href='/sisForo/topicos.php?cid=".$row['id_categorias']."&scid=".$row['id_subcat']."'>
					".$row['subcategoria_titulo']."<br/>";
			echo $row['subcategoria_desc']."</a></td>";
			echo "<td class='num-topics'>".getnumstopics($parent_id, $row['id_subcat'])."</td></tr>";
		}
	}


	function getnumstopics($id_categorias, $id_subcat){
		include('dbconn.php');

		$select = mysqli_query($con, "SELECT id_categoria, id_subcategoria FROM topicos WHERE ".$id_categorias." = id_categoria
										AND ".$id_subcat." = id_subcategoria");
		return mysqli_num_rows($select);
	}


	function disptopicos($cid, $scid) {
		include ('dbconn.php');
		$select = mysqli_query($con, "SELECT id_topico, autor, titulo, fecha_posteo, vistas, replies FROM categorias, subcategorias, topicos 
									  WHERE ($cid = topicos.id_categoria) AND ($scid = topicos.id_subcategoria) AND ($cid = categorias.id_categorias)
									  AND ($scid = subcategorias.id_subcat) ORDER BY id_topico DESC");
		if (mysqli_num_rows($select) != 0) {
			echo "<table class='topic-table'>";
			echo "<tr><th>Titulo</th><th>Posteado Por</th><th>Fecha Posteo</th><th>Vistas</th><th>Respuestas</th></tr>";
			while ($row = mysqli_fetch_assoc($select)) {
				echo "<tr><td><a href='/sisForo/vertopico.php?cid=".$cid."&scid=".$scid."&tid=".$row['id_topico']."'>
					 ".$row['titulo']."</a></td><td>".$row['autor']."</td><td>".$row['fecha_posteo']."</td><td>".$row['vistas']."</td>
					 <td>".$row['replies']."</td></tr>";
			}
			echo "</table>";
		} else {
			echo "<p>Esta categoria aun no tiene topicos!  <a href='/sisForo/nuevotopico/".$cid."/".$scid."'>
				 Agrega el primer topico de la categoria!</a></p>";
		}
	}

	function disptopico($cid, $scid, $tid){
		include('dbconn.php');
		$select = mysqli_query($con, "SELECT id_categoria, id_subcategoria, id_topico, autor, titulo, contenido, fecha_posteo FROM 
									  categorias, subcategorias, topicos WHERE ($cid = categorias.id_categorias) AND ($scid = subcategorias.id_subcat) 
									  AND ($tid = topicos.id_topico)");

		$row = mysqli_fetch_assoc($select);
		echo nl2br("<div class='content'><h2 class='title'>".$row['titulo']."</h2><p>".$row['autor']."\n".$row['fecha_posteo']."</p></div>");
		echo "<div class='content'><p>".$row['contenido']."</p></div>";
	}

	function addvistas($cid, $scid, $tid){
		include('dbconn.php');
		$update = mysqli_query($con, "UPDATE topicos SET vistas = vistas + 1 WHERE id_categoria = ".$cid." AND 
									  id_subcategoria = ".$scid." AND id_topico = ".$tid."");
	}


	function replylink($cid, $scid, $tid){
		echo "<p><a href='/sisForo/replyto.php?cid=".$cid."&scid=".$scid."&tid=".$tid."'>Responder a este post</a></p>";
	}	

	function replytopost($cid, $scid, $tid){
		echo "<div class='content'><form action='/sisForo/addreply.php?cid=".$cid."&scid=".$scid."&tid=".$tid."' method='POST'
			  <p>Commentario:</p>
			  <textarea cols='80' rows='5' id='comentario' name='comentario'></textarea><br/>
			  <input type='submit' value='Agregar Commentario' /> 
			  </form></div>";
	}

 ?>