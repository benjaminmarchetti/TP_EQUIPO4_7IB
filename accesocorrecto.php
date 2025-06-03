<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ingreso.php");
    exit();
}

$usuario = $_SESSION["usuario"];
?>
<!DOCTYPE html>  
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Correcto</title>
</head>
<body>
    <h1>Bienvenido, inicio de sesión exitoso</h1>
</body>
</html>