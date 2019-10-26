<?php
	$host = 'localhost';
	$usuario = 'postgres';
	$password = 'Equipo32019';
	$base = 'Instagram';
	$s = "host=".$host." dbname=".$base." user=".$usuario." password=".$password;
	$conexion = pg_connect($s) or die ('No se ha podido conectar: '.pg_last_error());









	if (isset($_POST["cambiar"])) {
		$id_usuario = $_POST["id"];
		$nombre  = $_POST["nombre"];
		$descripcion = $_POST["descripcion"];
		$correo = $_POST["correo"];
		$pass  = $_POST["pass"];
		$id = $_GET["id"];
		pg_query($conexion,"UPDATE usuarios SET
			id_usuario = '$id_usuario',
			n_usuario='$nombre',
			descripcion = '$descripcion',
			correo = '$correo',
			pass = '$pass'
			WHERE id_usuario = '$id';
			  ");
		header("Location: editar_perfil.php?id=".$id_usuario);
	  	exit();
	}




	if (isset($_POST["iniciar_sesion"])) {
		$id = $_POST["id_usuario"];
		$pass = $_POST["pass"];
		$resultado = pg_query($conexion,"SELECT pass FROM usuarios WHERE id_usuario = '$id';");
		$arreglo = pg_fetch_assoc($resultado);
		if ($arreglo["pass"]==$pass) {
			header("Location: inicio.php?id=".$id);
			exit();
		}else{
			header("Location: logeo.php");
			exit();
		}
	}

	if (isset($_POST["registrarte"])) {
		$correo = $_POST["email_usuario"];
		$nombre = $_POST["nombre_usuario"];
		$id = $_POST["id_usuario"];
		$pass = $_POST["pass"];
		pg_query($conexion,"INSERT INTO usuarios(id_usuario,n_usuario,correo,pass)
		values ('$id','$nombre','$correo','$pass');");
		header("Location: logeo.php");
		exit();
	}

	if (!isset($_GET["opc"])) {
		include("portada.php");
	}
	else {
		if ($_GET["opc"] == "logeo") {
			include("logeo.php");
		}
		elseif ($_GET["opc"] == "registro") {
			include("registro.php");
		}
	}

	pg_close($conexion);
 ?>
