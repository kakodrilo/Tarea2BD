<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Instagram</title>
		<link rel="stylesheet" type="text/css" href="css/estilos.css">
	</head>
	<body class="body">
			<div class="imagenes">
				<img id="imagen_fondo2" src="img/fondo_inicio2.jpg"  alt="">
				<img id="imagen_fondo" src="img/fondo_inicio.png"  alt="">
			</div>
			<fieldset class="info">
				<section class="form">
					<h1>Instagram</h1>
					<h5>Regístrate para ver fotos de tus amigos.</h5>
					<form  action="" method="post">
						<input type="email" name="email_usuario" placeholder="Correo electrónico"><br>
						<input type="text" name="nombre_usuario" placeholder="Nombre completo"><br>
						<input type="text" name="id_usuario" placeholder="Nombre de usuario"><br>
						<input type="password" name="pass" placeholder="Contraseña"><br>
						<input href="?opc=logeo" type="submit" name="registrarte" value="Registrarte">
						<p>Al registrarte, aceptas nuestras <b>Condiciones</b>,
							la <b>Política de datos</b> y la <b>Política de cookies</b>.
						</p>
					</form>
				</section>
				<section  class="registrate_logeo">
					¿Tienes una cuenta? <a href="?opc=logeo">Inicia sesión</a>
				</section>
			</fieldset>
	</body>
</html>
