<html>
	<head>
		<title></title>
		<meta charset="utf-8">
	</head>
	<body>
		<?php
			$conexion = mysqli_connect("localhost", "root", "", "pruebas");
		
			/* Comprobar conexion */
			if(!$conexion)
			{
				echo "La conexion ha fallado: ".mysqli_error();
				
				exit();
			}
			
			if($_FILES['imagen']['error'])
			{
				switch($_FILES['imagen']['error'])
				{
					case 1: 
						echo "El tamaño del archivo excede lo permitido por el servidor.";
					break;
					
					case 2:
						echo "El tamaño de archivo excede 2 MB.";
					break;
					
					case 3:
						echo "El envio de archivo se interrumpió.";
					break;
					
					case 4:
						echo "No se ha subido ningún fichero.";
					break;
				}
			}
			else
			{
				echo "Entrada subida correctamente.<br>";
				
				if((isset($_FILES['imagen']['name']) && ($_FILES['imagen']['error']==UPLOAD_ERR_OK)))
				{
					$destino_de_ruta="imagenes/";
					
					move_uploaded_file($_FILES['imagen']['tmp_name'], $destino_de_ruta . $_FILES['imagen']['name']);
					
					echo "El archivo " . $_FILES['imagen']['name'] . "Se ha copiado en el directorio de imagenes.";
				}
				else
				{
					echo "El archivo no se ha podido copiar en el directorio de imagenes";
				}
			}
			
			$eltitulo = $_POST['campo_titulo'];
			
			$lafecha = date("Y-m-d H:i:s");
			
			$elcomentario = $_POST['area_comentarios'];
			
			$laimagen = $_FILES['imagen']['name'];
			
			
			$consulta = "INSERT INTO CONTENIDO (Titulo, Fecha, Comentario, Imagen) VALUES('" . $eltitulo . "', '" . $lafecha . "', '" . $elcomentario . "', '" . $laimagen . "')";
		
			$resultado = mysqli_query($conexion,$consulta);
			
			
			mysqli_close($conexion);
			
			
			echo "<br>Se ha agregado el comentario conéxito.<br><br>";
		?>
		
		<a href="Formulario.php">Añadir nueva entrada</a>
		<br>
		<a href="Mostrar_Blog.php">Ver blog</a>
	</body>
</html>