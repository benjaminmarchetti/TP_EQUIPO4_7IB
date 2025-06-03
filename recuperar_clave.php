<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olvido de Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background:linear-gradient(to right, #87CEEB, #ffffff);
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        .container-recuperar {
            max-width: 400px;
            margin: 60px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 48px rgba(0,0,0,0.40);
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
    <div class="titulo-recuperar">Recuperar contraseña</div>
    <form action="recuperar_clave.php" method="post" class="mb-3">
        <div class="mb-3">
            <label for="email" class="form-label">Ingrese su email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="ejemplo@email.com" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Enviar</button>
    </form>

    <?php 
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $conex = mysqli_connect("localhost", "root", "", "nusuario");

        $email = mysqli_real_escape_string($conex, $_POST['email']);
        $c = "SELECT *, IFNULL(email, 'registronuevo') as email FROM registronuevo WHERE email='$email' LIMIT 1";
        $f = mysqli_query($conex, $c);
        $a = mysqli_fetch_assoc($f);
        if (!$a) {
            echo '<div class="alert alert-danger">Usuario inexistente</div>';
            die();
        }

        $token = md5($a['email'] . time() . rand(1000, 9999));
        $clave_nueva = rand(10000000, 99999999);
        $idusuario = $a['email'];
        $c2 = "INSERT INTO recuperar SET email='$email', TOKEN='$token', FECHA_ALTA=NOW(), CLAVE_NUEVA='$clave_nueva' ON DUPLICATE KEY UPDATE TOKEN='$token', CLAVE_NUEVA='$clave_nueva'";
        mysqli_query($conex, $c2);

        $link = "http://localhost/recuperar_clave_confirmar.php?e=$email&t=$token";

        $mensaje = <<<EMAIL
        <div class="alert alert-info mt-3">
            <p>Hola <b>{$a['email']}</b></p>
            <p>Has solicitado recuperar tu contraseña. El sistema te ha generado una nueva clave que es: <code style='background: lightyellow; color: darkred; padding: 1px 2px;'>$clave_nueva</code></p>
            <p>Pero antes de poder usarla, deberás hacer <a href='$link'>clic en este vínculo</a> o copiar este código en la URL de tu navegador</p>
            <code style='background: black; color: white; padding: 4px; display:block; margin-bottom:8px;'>$link</code>
            <p>Si tú no has hecho esta solicitud, ignora el presente mensaje</p>
        </div>
        EMAIL;

        echo $mensaje;
    }
    ?>
    <a href="index.php" class="btn btn-outline-primary volver-btn">Volver al inicio</a>
</div>
</body>
</html>
