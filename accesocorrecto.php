<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["usuario"])) {
    // Si no hay sesión iniciada, redirigir al inicio de sesión
    header("Location: ingreso.php");
    exit();
}

// Mostrar mensaje de bienvenida
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
    <h1>Bienvenido,inicio de sesión exitoso</h1>
</body>
</html>