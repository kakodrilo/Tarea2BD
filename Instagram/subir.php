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
			<form enctype='multipart/form-data' class="subir_foto" action="perfil.php?id=<?php echo $_GET["id"]; ?>" method="post">
				<input type="file" name="foto"  accept="image/*" > <br>
				<br> <input type="text" name="descripcion" placeholder="Descripción"> <br>
				<input type="submit" name="nueva_publicacion" value="Aceptar">
			</form>
		</div>
	</body>
</html>
