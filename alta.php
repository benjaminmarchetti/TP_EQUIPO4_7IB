<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>alta.php</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #87CEEB, #ffffff);
            padding: 40px;
        }
        input[type="text"], input[type="password"], input[type="submit"] {
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: rgb(9, 132, 227);
            border: none;
            cursor: pointer;
            font-weight: 600;
        }

        input[type="submit"]:hover {
            background-color:rgb(8, 90, 150);
        }

        form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 10px; 
            box-shadow: 0 8px 48px rgba(0,0,0,0.40);
        }
    </style>
</head>
<body>
    <?php
    //Conexion con la base
    $conex = mysqli_connect("localhost", "root", "", "nusuario"); 
    ?>
    <form action="alta.php" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" placeholder="Nuevo Nombre" required>
        
        <label for="apellido">Apellido</label>
        <input type="text" name="apellido" id="apellido" placeholder="Nuevo Apellido" required>
        
        <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="Ingresar Email" required>
        
        <label for="User">Usuario</label>
        <input type="text" name="User" id="User" placeholder="Ingresar Usuario" required>
        
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Ingrese Contraseña" required>
        
        <label for="Cpassword">Confirmar Password</label>
        <input type="password" name="Cpassword" id="Cpassword" placeholder="Confirme Contraseña" required>
        
        <input type="submit" name="Enviar" value="Registrar">
    </form>

    <div style="text-align: center; margin-top: 20px;">
        <a href="index.php" class="btn btn-primary" style="text-decoration: none; padding: 10px 20px; border-radius: 10px; background-color: rgb(9, 132, 227); color: white; font-weight: 600;">Volver al Inicio</a>
    </div>

    <?php    
    if (isset($_POST['Enviar'])) {
        if (
            strlen($_POST['nombre']) >= 1 &&
            strlen($_POST['apellido']) >= 1 &&
            strlen($_POST['email']) >= 1 &&
            strlen($_POST['User']) >= 1 &&
            strlen($_POST['password']) >= 1 &&
            $_POST['password'] === $_POST['Cpassword']
        ) {
            $nombre = trim($_POST['nombre']);
            $apellido = trim($_POST['apellido']);
            $email = trim($_POST['email']);
            $User = trim($_POST['User']);
            $password = $_POST['password'];
            $pass_cifrada = password_hash($password, PASSWORD_DEFAULT, array("cost" => 10));
            $consulta = "INSERT INTO registronuevo (nombre, apellido, email, user, pass) VALUES ('$nombre','$apellido','$email','$User','$pass_cifrada')";
            $resultado = mysqli_query($conex, $consulta);
            if ($resultado) {
                echo '<h3 class="ok">¡Te has inscripto correctamente!</h3>';
            } else {
                echo '<h3 class="bad">¡Ups ha ocurrido un error!</h3>';
            }
        } else {
            echo '<h3 class="bad">¡Por favor complete los campos!</h3>';
        }
    }
    ?>
</body>
</html>