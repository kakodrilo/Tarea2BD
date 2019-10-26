<?php

$id = $_GET["id"];

if (isset($_POST["editar"])) {
	header("Location: editar_perfil.php?id=".$id);
	exit();
}

if (isset($_POST["subir_foto"])) {
	header("Location: subir.php?id=".$id);
	exit();
}
$host = 'localhost';
$usuario = 'postgres';
$password = 'Equipo32019';
$base = 'Instagram';
$s = "host=".$host." dbname=".$base." user=".$usuario." password=".$password;
$conexion = pg_connect($s) or die ('No se ha podido conectar: '.pg_last_error());


if (isset($_POST["nueva_publicacion"])) {
	if (($_FILES['foto']['name']!="")){
// Where the file is going to be stored
		$descripcion = $_POST["descripcion"];
		$target_dir = "img/";
		$file = $_FILES['foto']['name'];
		$path = pathinfo($file);
		$filename = $path['filename'];
		$ext = $path['extension'];
		$temp_name = $_FILES['foto']['tmp_name'];
		$path_filename_ext = $target_dir.$filename.".".$ext;
		if (!file_exists($path_filename_ext)) {
		 	move_uploaded_file($temp_name,$path_filename_ext);
			pg_query($conexion,"INSERT INTO publicaciones(id_usuario,direccion,descripcion) values('$id','$path_filename_ext','$descripcion');");
		}
	}

}


$resultado = pg_query($conexion,"SELECT *
	FROM usuarios where id_usuario = '$id';");
$arreglo = pg_fetch_assoc($resultado);

$nombre = $arreglo["n_usuario"];
$foto = $arreglo["direccion_p"];
$publicaciones = $arreglo["c_publicaciones"];
$seguidos = $arreglo["c_seguidos"];
$seguidores = $arreglo["c_seguidores"];
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
		</div>
		<div class="contenido_perfil">
			<div class="info_usuario">
				<img src="<?php echo $foto ?>" class="foto_perfil_perfil">
				<div class="info_perfil">
					<form action="" method="post">
						<h1><?php echo $id ?></h1>
						<input type="submit" name="subir_foto" value="Subir Foto">
						<input type="submit" name="editar" value="Editar Perfil">
					</form>

					<div class="numeros">
						<h4><?php echo "$publicaciones publicaciones";?></h4>
						<h4><?php echo "$seguidores seguidores";?></h4>
						<h4><?php echo "$seguidos seguidos";?></h4>
					</div>
						<h3><?php echo $nombre ?></h3>
						<h5><?php echo $descripcion ?></h5>
				</div>
			</div>
		</div>
		<div class="fotos">
			<?php
				$resultado = pg_query($conexion,"SELECT id_publicacion, direccion FROM publicaciones WHERE id_usuario = '$id' ORDER BY id_publicacion DESC;");
				while ($arreglo = pg_fetch_assoc($resultado)) {
					echo "<a href='publicacion.php?id=".$id."&id_p=".$arreglo['id_publicacion']."'> <img class='imagenes_perfil' src='".$arreglo['direccion']."'> </a>";
				}
			 ?>
		</div>
	</body>
</html>

<?php

pg_close($conexion);
 ?>
