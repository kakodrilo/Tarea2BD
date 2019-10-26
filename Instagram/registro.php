<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Registrarte - Instagram</title>
		<link rel="stylesheet" type="text/css" href="css/estilos.css">
	</head>
	<body>
				<section class="form">
					<h1>Instagram</h1>
					<h5>Regístrate para ver fotos de tus amigos.</h5>
					<form  action="index.php" method="post">
						<input type="email" name="email_usuario" placeholder="Correo electrónico"><br>
						<input type="text" name="nombre_usuario" placeholder="Nombre completo"><br>
						<input type="text" name="id_usuario" placeholder="Nombre de usuario"><br>
						<input type="password" name="pass" placeholder="Contraseña"><br>
						<input type="submit" name="registrarte" value="Registrarte">
						<p>Al registrarte, aceptas nuestras <b>Condiciones</b>,
							la <b>Política de datos</b> y la <b>Política de cookies</b>.
						</p>
					</form>
				</section>
				<section  class="registrate_logeo">
					¿Tienes una cuenta? <a href="?opc=logeo">Inicia sesión</a>
				</section>
	</body>
</html>
