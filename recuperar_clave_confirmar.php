<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f6fa;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        .container-recuperar {
            max-width: 400px;
            margin: 60px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 48px rgba(0,0,0,0.40); /* Sombra más visible */
            padding: 36px 30px 28px 30px;
        }
        .titulo-recuperar {
            font-size: 2rem;
            font-weight: 700;
            color: #0984e3;
            margin-bottom: 22px;
            text-align: center;
            letter-spacing: 0.5px;
        }
        .mensaje-recuperar {
            font-size: 1.13rem;
            color: #636e72;
            text-align: center;
            margin-bottom: 12px;
        }
        .email-card {
            background: linear-gradient(90deg, #eaf4fb 60%, #d0e6fa 100%);
            border-radius: 8px;
            padding: 14px 0;
            font-size: 1.13rem;
            color: #0984e3;
            font-weight: 600;
            text-align: center;
            margin-top: 18px;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(9,132,227,0.07);
        }
        .alert {
            font-size: 1.05rem;
            text-align: center;
            margin-bottom: 18px;
        }
        .volver-btn {
            display: block;
            margin: 22px auto 0 auto;
            width: 100%;
            max-width: 220px;
        }
    </style>
</head>
<body>
<div class="container-recuperar">
    <div class="titulo-recuperar">Recuperación de contraseña</div>
    <?php 
    //Conexion con la base
    $conex = mysqli_connect("localhost","root","","nusuario");
    $email = $_GET['e'];
    $token = $_GET['t'];

    $c = "SELECT CLAVE_NUEVA FROM recuperar WHERE EMAIL='$email' AND TOKEN='$token' LIMIT 1 ";
    $f = mysqli_query( $conex, $c );
    $a = mysqli_fetch_assoc($f);
    if( ! $a ){
        echo '<div class="alert alert-danger">Solicitud no encontrada</div>';
        echo '<a href="index.php" class="btn btn-outline-primary volver-btn">Volver al inicio</a>';
        die();
    }

    //OBTENEMOS LA CLAVE Y ACTUALIZAMOS AL USUARIO
    $clave = $a['CLAVE_NUEVA'];
    $clave_ = password_hash($clave,PASSWORD_DEFAULT, array("cost"=>10));
    $c2 = "UPDATE registronuevo SET pass='$clave_' WHERE email='$email' LIMIT 1";
    mysqli_query($conex, $c2);

    //ELIMINAR ESTA SOLICITUD DE RECUPERO
    $c3 = "DELETE FROM recuperar WHERE EMAIL='$email' LIMIT 1";
    mysqli_query($conex, $c3);

    echo '<div class="alert alert-success">Contraseña actualizada satisfactoriamente, ya se puede loguear</div>';
    ?>
    <div class="mensaje-recuperar">
        Se realizó la recuperación para el siguiente correo:
    </div>
    <div style="display: flex; justify-content: center;">
        <div style="
            background: #eaf4fb;
            border-radius: 18px;
            padding: 10px 22px;
            font-size: 1.13rem;
            color: #0984e3;
            font-weight: 600;
            margin-left: 8px;
            box-shadow: 0 2px 8px rgba(9,132,227,0.07);
            display: inline-block;
        ">
            <?php echo htmlspecialchars($email); ?>
        </div>
    </div>
    <a href="index.php" class="btn btn-primary volver-btn">Volver al inicio</a>
</div>
</body>
</html>