<?php

$host = 'localhost';
$usuario = 'postgres';
$password = "Equipo32019";
$base = "Instagram";

$s = "host=".$host." dbname=".$base." user=".$usuario." password=".$password;
$conexion = pg_connect($s)
 or die('No se ha podido conectar: '.pg_last_error());

pg_query($conexion,"CREATE TABLE usuarios (
	ID_usuario VARCHAR(30) PRIMARY KEY,
	n_usuario VARCHAR(50) NOT NULL,
	correo VARCHAR(50) NOT NULL,
	pass VARCHAR(50) NOT NULL,
	c_seguidores INT DEFAULT 0,
	c_seguidos INT DEFAULT 0,
	c_publicaciones INT DEFAULT 0,
	descripcion VARCHAR(150),
	direccion_p VARCHAR(150) DEFAULT 'img/perfil_defecto.png'
);");

pg_query($conexion,"CREATE TABLE publicaciones(
	ID_publicacion SERIAL PRIMARY KEY,
	ID_usuario VARCHAR(30),
	fecha DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
	direccion VARCHAR(150),
	n_comentarios INT DEFAULT 0,
	n_likes INT DEFAULT 0,
	descripcion VARCHAR(150),
	CONSTRAINT foranea_publicaciones FOREIGN KEY (ID_usuario)
	REFERENCES usuarios(ID_usuario)
);");

pg_query($conexion,"CREATE TABLE follows(
	ID_usuario1 VARCHAR(30) NOT NULL,
	ID_usuario2 VARCHAR(30) NOT NULL,
	PRIMARY KEY(ID_usuario1,ID_usuario2)
);");

pg_query($conexion,"CREATE TABLE notificaciones(
	ID_notificacion SERIAL PRIMARY KEY,
	ID_usuario1 VARCHAR(30) NOT NULL,
	ID_usuario2 VARCHAR(30) NOT NULL,
	ID_publicacion INT, /* nulo = noticficacion de follow*/
	FOREIGN KEY (ID_usuario1) REFERENCES usuarios(ID_usuario),
	FOREIGN KEY (ID_usuario2) REFERENCES usuarios(ID_usuario),
	FOREIGN KEY (ID_publicacion) REFERENCES publicaciones(ID_publicacion)
);");

pg_query($conexion,"CREATE TABLE comentarios(
	ID_comentario SERIAL PRIMARY KEY,
	ID_usuario VARCHAR(30) NOT NULL,
	ID_publicacion INT NOT NULL,
	comentario VARCHAR(150) NOT NULL,
	FOREIGN KEY (ID_usuario) REFERENCES usuarios(ID_usuario),
	FOREIGN KEY (ID_publicacion) REFERENCES publicaciones(ID_publicacion)
);");

pg_query($conexion,"CREATE TABLE tags_publicacion(
	nombre_tag VARCHAR(20) NOT NULL,
	ID_publicacion INT NOT NULL,
	PRIMARY KEY (nombre_tag,ID_publicacion)
);");

pg_query($conexion,"CREATE TABLE tags(
	nombre_tag VARCHAR(20) NOT NULL PRIMARY KEY
);");

pg_query($conexion,"CREATE TABLE likes(
	ID_usuario VARCHAR(30) NOT NULL,
	ID_publicacion INT NOT NULL,
	PRIMARY KEY (ID_publicacion,ID_usuario)
);");


pg_close($conexion);

 ?>
