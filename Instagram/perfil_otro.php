<?php

$id = $_GET["id"];
$id2 = $_GET["id2"];



$host = 'localhost';
$usuario = 'postgres';
$password = 'Equipo32019';
$base = 'Instagram';
$s = "host=".$host." dbname=".$base." user=".$usuario." password=".$password;
$conexion = pg_connect($s) or die ('No se ha podido conectar: '.pg_last_error());

if (isset($_POST["seguir"])) {
	pg_query($conexion,"INSERT INTO follows values ('$id','$id2');");
}

if (isset($_POST["no_seguir"])) {
	pg_query($conexion,"DELETE FROM follows WHERE id_usuario1 ='$id' AND id_usuario2 = '$id2';");
}



$resultado = pg_query($conexion,"SELECT *
	FROM usuarios where id_usuario = '$id2';");
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
						<h1><?php echo $id2 ?></h1>
						<?php
						$resultado = pg_query($conexion,"SELECT * FROM follows WHERE id_usuario1 = '$id' AND id_usuario2 = '$id2';");
						if (pg_num_rows($resultado)==0) {
							echo "<input type='submit' name='seguir' value='Seguir'>";
						}
						else {
							echo "<input type='submit' name='no_seguir' value='Dejar de seguir'>";
						}

						 ?>
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
				$resultado = pg_query($conexion,"SELECT id_publicacion, direccion FROM publicaciones WHERE id_usuario = '$id2' ORDER BY id_publicacion DESC;");
				while ($arreglo = pg_fetch_assoc($resultado)) {
					echo "<a href='publicacion.php?id=".$id."&id_p=".$arreglo['id_publicacion']."'> <img class='imagenes_perfil' src='".$arreglo['direccion']."'> </a>";
				}
			 ?>
		</div>
	</body>
</html>
