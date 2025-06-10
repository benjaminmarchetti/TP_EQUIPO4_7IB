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
Nombre, Apellido, Email, Usuario y Contraseña. Si todos los campos contienen al menos un caracter y la contraseña es igual a la confirmación de la contraseña, se envía el formulario.
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
  	. Actualiza la clave en la tabla “registronuevo.”
  	. Elimina el token usado de la tabla “recuperar”.

Base de datos 

- nusuario.sql
Contiene dos tablas:
	. registronuevo: guarda datos de usuarios.
  	. recuperar: guarda los datos temporales de recuperación (email, nueva clave, token, fecha).

Conexión a la base de datos

- config.php: define variables como servidor, usuario, clave, y nombre de la base de datos.
- db.php: usa esas variables para conectarse con mysqli_connect.

A continuación, el paso a paso para poder visualizar este trabajo en otra computadora.

1. Crear la base de datos
	. Abrir phpMyAdmin desde XAMPP.
	. Crear una base de datos nueva con el nombre: nusuario
	. Importar el archivo nusuario.sql dentro de esa base de datos desde la pestaña "importar"

2. Copiar los archivos del sistema en XAMPP
	. Abrir la carpeta donde está instalado XAMPP.
	. Ir a la carpeta: C:\xampp\htdocs\
	. Copiar allí todos los archivos del sistema (como index.php, alta.php, etc.)
	. Asegurarse de que también esté presente Composer si se usará el login con Google.
   
3. Configurar las credenciales de Google (OAuth)
	. Acceder a Google Cloud Console.
	. Crear un nuevo proyecto o usar uno existente.
	. Habilitar la API “OAuth 2.0 Client IDs” en la sección de Credenciales.
	. Configurar:
		. URI de redirección autorizada: http://localhost/index.php
   		. Obtener:
			. Client ID
			. Client Secret
	. Abrir el archivo config.php y reemplazar las líneas correspondientes:
		$google_client->setClientId('xxxx');
		$google_client->setClientSecret('xxxx');
4. Iniciar el sistema
	. Asegurarse de que Apache y MySQL estén activos en XAMPP.
	. Abrir un navegador web.
	. Ir a la siguiente URL: http://localhost
