# TP_EQUIPO4_7IB
Inicio de sesión

- index.php:
Es el formulario de inicio de sesión. Pide el usuario y contraseña o te permite ingresar con Google además de poder recuperar la contraseña. 
Por último, envía los datos a ingreso.php mediante el método POST.

- ingreso.php:
Conecta a la base de datos (config.php y db.php).
Busca en la tabla “registronuevo” un usuario y verifica la contraseña con password_verify().
Si es correcta, redirige a accesocorrecto.php.
Si no, muestra un mensaje de error.

Acceso correcto

- accesocorrecto.php
Muestra un mensaje indicando que el ingreso fue exitoso.

Registro de nuevo usuario 

- alta.php
Muestra un formulario para registrar a un nuevo usuario y pide los siguientes datos:
Nombre, Apellido, Email, Usuario y Contraseña.
Al enviar el formulario:
Se conecta a la base de datos y se guarda el nuevo usuario en la tabla “registronuevo”, con la contraseña encriptada usando password_hash().

Recuperación de contraseña

- recuperar_clave.php:
Muestra un formulario para ingresar el email.
Genera un token y una clave nueva aleatoria.
Guarda estos datos en la tabla “recuperar”.
Muestra la clave nueva y el token.

- recuperar_clave_confirmar.php:
Verifica que el token exista y no esté vencido.
Si el token es válido:
	•	Actualiza la clave en la tabla “registronuevo.”
	•	Elimina el token usado de la tabla “recuperar”.

Base de datos 

- nusuario.sql
Contiene dos tablas:
	•	registronuevo: guarda datos de usuarios.
	•	recuperar: guarda los datos temporales de recuperación (email, nueva clave, token, fecha).

Conexión a la base de datos

- config.php: define variables como servidor, usuario, clave, y nombre de la base de datos.
- db.php: usa esas variables para conectarse con mysqli_connect.
