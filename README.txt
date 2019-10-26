----------------------------------
=====> Instagram v1.1.0 <=====    
----------------------------------
09/08/2019
----------------------------------

Joaquín Castillo Tapia       201773520-1
María Paz Morales Llopis     201773505-8

----------------------------------

REQUISITOS:
==================================================

- Windows 10 o superior (64-bits)
- PostreSQL 11.4 (64-bits)
- PHP 4.7 (64-bits)
- XAMMP 7.3.7 (64-bits)

==================================================

INSTALACIÓN:
==================================================

- Crear una Base da Datos en PostgreSQL 11.4 con nombre "Instagram" y contraseña "Equipo32019"
- Activar el servidor Apache
- Mover la carpeta Instagram al directorio xammp/htdocs/
- Abrir el navegador en el enlace localhost/Instagram/base_de_datos.php y luego al enlace localhost/Instagram/triggers.php
- Ejecutar localhost/Instagram
==================================================


CONSIDERACIONES:
==================================================
• Los comentarios no pueden recibir Likes.
• Los comentarios no pueden tener respuesta.
• No es necesaria una ID de Follow para identificar la notificación.
• En la Base de Datos se guarda la dirección del archivo de cada publicación, y no el video o foto correspondiente. Del mismo modo ocurre con la foto de perfil de cada usuario.
• Los comentarios no pueden tener Tags.
• No se puede etiquetar a otros usuarios en la publicaciones.
