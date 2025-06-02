<?php
// Conexion con la base
$conex = mysqli_connect("localhost", "root", "", "nusuario"); 

// Obtener las credenciales del formulario
$usuario = $_POST['usuario'];
$password = $_POST['password'];

// Verificar si el usuario existe en la base de datos
$sql = "SELECT * FROM registronuevo WHERE user = '$usuario'";
$result = mysqli_query($conex, $sql);


echo '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ingreso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f6fa;
            font-family: "Segoe UI", Arial, sans-serif;
        }
        .container-login {
            max-width: 400px;
            margin: 80px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 48px rgba(0,0,0,0.40);
            padding: 36px 30px 28px 30px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container-login">';


if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $hashedPassword = $row['pass'];

    if (password_verify($password, $hashedPassword)) {
        session_start();
        $_SESSION["usuario"] = $usuario;
        header("Location: accesocorrecto.php");
        exit;
    } else {
        echo '<div class="alert alert-danger">Contraseña incorrecta.</div>';
        echo '<a href="index.php" class="btn btn-outline-primary mt-3 fw-semibold">Volver a iniciar sesión</a>';
    }
} else {
    echo '<div class="alert alert-danger">Usuario inexistente.</div>';
    echo '<a href="index.php" class="btn btn-outline-primary mt-3 fw-semibold">Volver a iniciar sesión</a>';
}

echo '</div></body></html>';

mysqli_close($conex);
?>
