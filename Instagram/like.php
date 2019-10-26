<?php
$host = 'localhost';
$usuario = 'postgres';
$password = 'Equipo32019';
$base = 'Instagram';
$s = "host=".$host." dbname=".$base." user=".$usuario." password=".$password;
$conexion = pg_connect($s) or die ('No se ha podido conectar: '.pg_last_error());

$id = $_GET["id"];
$id_p = $_GET["id_p"];

$r = pg_query($conexion,"SELECT * FROM likes WHERE id_usuario = '$id' AND id_publicacion = $id_p;");
if (pg_num_rows($r)!=0) {
	pg_query($conexion,"DELETE FROM likes WHERE id_usuario = '$id' AND id_publicacion = $id_p;");
}else{
	pg_query($conexion,"INSERT INTO likes values('$id', $id_p);");
}

pg_close($conexion);

header("Location: publicacion.php?id=".$id."&id_p=".$id_p);
exit();



 ?>
