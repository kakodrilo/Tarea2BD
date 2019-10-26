<?php

$id = $_GET["id"];

$host = 'localhost';
$usuario = 'postgres';
$password = 'Equipo32019';
$base = 'Instagram';
$s = "host=".$host." dbname=".$base." user=".$usuario." password=".$password;
$conexion = pg_connect($s) or die ('No se ha podido conectar: '.pg_last_error());

if (isset($_POST["nueva_foto"])) {
	if (($_FILES['foto_perfil']['name']!="")){
// Where the file is going to be stored
		$target_dir = "img/";
		$file = $_FILES['foto_perfil']['name'];
		$path = pathinfo($file);
		$filename = $path['filename'];
		$ext = $path['extension'];
		$temp_name = $_FILES['foto_perfil']['tmp_name'];
		$path_filename_ext = $target_dir.$filename.".".$ext;
		if (!file_exists($path_filename_ext)) {
		 	move_uploaded_file($temp_name,$path_filename_ext);
			echo "Congratulations! File Uploaded Successfully.";
			pg_query($conexion,"UPDATE usuarios SET direccion_p = '$path_filename_ext' WHERE id_usuario = '$id';");
		}
	}

}


$resultado = pg_query($conexion,"SELECT *
	FROM usuarios where id_usuario = '$id';");
$arreglo = pg_fetch_assoc($resultado);

$nombre = $arreglo["n_usuario"];
$foto = $arreglo["direccion_p"];
$correo = $arreglo["correo"];
$pass = $arreglo["pass"];
$descripcion = $arreglo["descripcion"];

 ?>



<!DOCTYPE html>
<html lang="es" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Instagram</title>
		<link rel="stylesheet" type="text/css" href="css/estilos2.css">
	</head>
	<body>
		<header>
			<div class="izq">
				<a href="inicio.php?id=<?php echo  $_GET["id"]; ?>">
					<img id="logo" src="img/logo.png">
					<h1>Instagram</h1>
				</a>
			</div>
			<div class="centro">
				<form action="busqueda.php?id=<?php echo $id ?>" method="post">
					<input type="text" name="busqueda" placeholder="Buscar">
				</form>
			</div>
			<div class="izq">
				<a href="index.php"> <img class="iconos" src="img/descubrir.png"> </a>
				<a href="#"> <img class="iconos" src="img/notificaciones.png"> </a>
				<a href="perfil.php?id=<?php echo  $_GET["id"]; ?>"> <img class="iconos" src="img/perfil.png"> </a>
			</div>
		</header>
		<div class="editar">
			<form enctype='multipart/form-data' class="cambiar_foto" action="editar_perfil.php?id=<?php echo $id; ?>" method="post">
				<img src="<?php echo $foto; ?>" alt=""> <br>
				<input type="file" name="foto_perfil"  accept="image/*" > <br>
				<input type="submit" name="nueva_foto" value="Aceptar">
			</form>
			<form class="form_editar" action="index.php?id=<?php echo $id; ?>" method="post">
				Nombre Usuario <br> <input type="text" name="id" value="<?php echo $id; ?>"> <br>
				Nombre <br> <input type="text" name="nombre" value="<?php echo $nombre; ?>"> <br>
				Descripción <br> <input id="descripcion" type="text" name="descripcion" value="<?php echo $descripcion; ?>"> <br>
				Correo electrónico <br> <input type="text" name="correo" value="<?php echo $correo; ?>"> <br>
				Contraseña <br> <input type="text" name="pass" value="<?php echo $pass; ?>"> <br>
				<input type="submit" name="cambiar" value="Aceptar">
 	 		</form>
		</div>
	</body>
</html>
