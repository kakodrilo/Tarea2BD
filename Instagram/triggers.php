<?php

$host = 'localhost';
$usuario = 'postgres';
$password = "Equipo32019";
$base = "Instagram";

$s = "host=".$host." dbname=".$base." user=".$usuario." password=".$password;
$conexion = pg_connect($s)
 or die('No se ha podido conectar: '.pg_last_error());


pg_query($conexion,"CREATE OR REPLACE FUNCTION update_usuario() RETURNS TRIGGER AS $$
BEGIN
    IF(NEW.c_seguidores = -1) THEN
		new.c_seguidores := old.c_seguidores + 1;
	ELSIF (new.c_seguidores = -2) THEN
		new.c_seguidores := old.c_seguidores - 1;
	END IF;
	IF(new.c_seguidos = -1) THEN
		new.c_seguidos := old.c_seguidos + 1;
	ELSIF (new.c_seguidos = -2) THEN
		new.c_seguidos := old.c_seguidos - 1;
	END IF;
	IF(new.c_publicaciones = -1) THEN
		new.c_publicaciones := old.c_publicaciones + 1;
	ELSIF (new.c_publicaciones = -2) THEN
		new.c_publicaciones := old.c_publicaciones - 1;
	END IF;
	RETURN NEW;
END;
$$ LANGUAGE plpgsql;

create trigger update_usuarios BEFORE update on usuarios for each row
execute procedure update_usuario();
");

pg_query($conexion,"CREATE OR REPLACE FUNCTION insert_follows() RETURNS TRIGGER AS $$
BEGIN
    UPDATE usuarios SET c_seguidos = -1 WHERE id_usuario = NEW.id_usuario1;
	UPDATE usuarios SET c_seguidores = -1 WHERE id_usuario = NEW.id_usuario2;
	INSERT INTO notificaciones(ID_usuario1,ID_usuario2) values (NEW.id_usuario1,NEW.id_usuario2);
	RETURN NEW;
END;
$$ LANGUAGE plpgsql;

create trigger insert_follow BEFORE insert on follows for each row
execute procedure insert_follows();
");

pg_query($conexion,"CREATE OR REPLACE FUNCTION delete_follows() RETURNS TRIGGER AS $$
BEGIN
    UPDATE usuarios SET c_seguidos = -2 WHERE id_usuario = OLD.id_usuario1;
	UPDATE usuarios SET c_seguidores = -2 WHERE id_usuario = OLD.id_usuario2;
	RETURN NEW;
END;
$$ LANGUAGE plpgsql;

create trigger delete_follow after delete on follows for each row
execute procedure delete_follows();
");

pg_query($conexion,"CREATE OR REPLACE FUNCTION insert_comentarios() RETURNS TRIGGER AS $$
BEGIN
    UPDATE publicaciones SET n_comentaios = -1 WHERE id_publicacion = NEW.id_publicacion;
	RETURN NEW;
END;
$$ LANGUAGE plpgsql;

create trigger insert_comentarios BEFORE insert on comentarios for each row
execute procedure insert_comentarios();
");

pg_query($conexion,"CREATE OR REPLACE FUNCTION delete_comentarios() RETURNS TRIGGER AS $$
BEGIN
    UPDATE publicaciones SET n_comentaios = -2 WHERE id_publicacion = OLD.id_publicacion;
	RETURN NEW;
END;
$$ LANGUAGE plpgsql;

create trigger delete_comentarios AFTER delete on comentarios for each row
execute procedure delete_comentarios();
");

pg_query($conexion,"CREATE OR REPLACE FUNCTION update_publicaciones() RETURNS TRIGGER AS $$
BEGIN
    IF(NEW.n_comentarios = -1) THEN
	NEW.n_comentarios = OLD.n_comentarios + 1;
	ELSIF(NEW.n_comentarios = -2) THEN
	NEW.n_comentarios = OLD.n_comentarios - 1;
	END IF;
	IF(NEW.n_likes = -1) THEN
	NEW.n_likes = OLD.n_likes + 1;
	ELSIF(NEW.n_likes = -2) THEN
	NEW.n_likes = OLD.n_likes - 1;
	END IF;
	RETURN NEW;
END;
$$ LANGUAGE plpgsql;

create trigger update_publicaciones BEFORE update on publicaciones for each row
execute procedure update_publicaciones();
");

pg_query($conexion,"CREATE OR REPLACE FUNCTION insert_likes() RETURNS TRIGGER AS $$
BEGIN
    UPDATE publicaciones SET n_likes = -1 WHERE id_publicacion = NEW.id_publicacion;
	RETURN NEW;
END;
$$ LANGUAGE plpgsql;

create trigger insert_likes BEFORE insert on likes for each row
execute procedure insert_likes();
");

pg_query($conexion,"CREATE OR REPLACE FUNCTION delete_likes() RETURNS TRIGGER AS $$
BEGIN
    UPDATE publicaciones SET n_likes = -2 WHERE id_publicacion = OLD.id_publicacion;
	RETURN NEW;
END;
$$ LANGUAGE plpgsql;

create trigger delete_likes AFTER delete on likes for each row
execute procedure delete_likes();
");

pg_query($conexion,"CREATE OR REPLACE FUNCTION insert_publicaciones() RETURNS TRIGGER AS $$
BEGIN
    UPDATE usuarios SET c_publicaciones = -1 WHERE id_usuario = NEW.id_usuario;
	RETURN NEW;
END;
$$ LANGUAGE plpgsql;

create trigger insert_publicaciones BEFORE insert on publicaciones for each row
execute procedure insert_publicaciones();
");


pg_query($conexion,"CREATE OR REPLACE FUNCTION delete_publicaciones() RETURNS TRIGGER AS $$
BEGIN
    UPDATE usuarios SET c_publicaciones = -2 WHERE id_usuario = NEW.id_usuario;
	RETURN NEW;
END;
$$ LANGUAGE plpgsql;

create trigger delete_publicaciones AFTER delete on publicaciones for each row
execute procedure delete_publicaciones();
");



 pg_close($conexion);

?>
