<?php

$host = 'localhost';
$usuario = 'postgres';
$password = 'Equipo32019';
$base = 'Instagram';
$s = "host=".$host." dbname=".$base." user=".$usuario." password=".$password;
$conexion = pg_connect($s) or die ('No se ha podido conectar: '.pg_last_error());

$id = $_GET["id"];
$id_p = $_GET["id_p"];


$resultado = pg_query($conexion,"SELECT id_usuario,n_likes,descripcion, direccion, n_comentarios FROM publicaciones
	WHERE id_publicacion = $id_p;");

$arreglo = pg_fetch_assoc($resultado);
$id_usuario = $arreglo["id_usuario"];
$n_likes = $arreglo["n_likes"];
$descripcion = $arreglo["descripcion"];
$direccion = $arreglo["direccion"];
$n_comentarios = $arreglo["n_comentarios"];

$r = pg_query($conexion,"SELECT direccion_p FROM usuarios WHERE id_usuario = '$id_usuario';");
$a = pg_fetch_assoc($r);
$direccion_p = $a["direccion_p"];

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
		<div class="contenido">
			<?php
			$r = pg_query($conexion,"SELECT * FROM likes WHERE id_usuario = '$id' AND id_publicacion = $id_p;");
			if (pg_num_rows($r)!=0) {
				$s="img/like2.png";
			}else{
				$s="img/like.png";
			}

			echo '
			<div class="publicacion">
				<div class="encabezado">
					<a href="perfil_otro.php?id='.$id.'&id2='.$id_usuario.'"><img src="'.$direccion_p.'" class="perfil_publicacion"></a>
					<a href="perfil_otro.php?id='.$id.'&id2='.$id_usuario.'"><h1>'.$id_usuario.'</h1></a>
				</div>
				<a href="publicacion.php?id='.$id.'&id_p='.$id_p.'"><img src="'.$direccion.'" class="imagen">
				<div class="pie_imagen">
					<a href="like.php?id='.$id.'&id_p='.$id_p.'"><img src="'.$s.'" class="iconos"></a>
					<a href="publicacion.php?id='.$id.'&id_p='.$id_p.'"><img src="img/comentario.png" class="iconos"></a>
					<h5>'.$n_likes.' Me gusta</h5>
					<p> <a href="perfil_otro.php?id='.$id.'&id2='.$id_usuario.'">'.$id_usuario.'</a> '.$descripcion.'</p>
				</div>

				<form class="comentario" action="" method="post">
					<input type="text" name="comentario" placeholder="Agregar un comentario...">
					<input type="submit" name="aceptar_comentario" value="Publicar">
				</form>
			</div>';

			 ?>
	</body>
</html>
