<?php
//Include Configuration File
include('config.php');

$login_button = '';

if (isset($_GET["code"])) {
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    if (!isset($token['error'])) {
        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];

        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();

        if (!empty($data['given_name'])) {
            $_SESSION['user_first_name'] = $data['given_name'];
        }

        if (!empty($data['family_name'])) {
            $_SESSION['user_last_name'] = $data['family_name'];
        }

        if (!empty($data['email'])) {
            $_SESSION['user_email_address'] = $data['email'];
        }

        if (!empty($data['gender'])) {
            $_SESSION['user_gender'] = $data['gender'];
        }

        if (!empty($data['picture'])) {
            $_SESSION['user_image'] = $data['picture'];
        }
    }
}

if (!isset($_SESSION['access_token'])) {
    $login_button = '<div style="position: relative; display: flex; justify-content: center; align-items: center; margin-top: 20px;">
        <img src="https://img.icons8.com/?size=512&id=17949&format=png" alt="Google Logo" style="
            position: absolute;
            left: -40px; /* Mueve el logo fuera del recuadro */
            width: 30px;
            height: 30px;">
        <a href="' . $google_client->createAuthUrl() . '" style="
            background:rgb(182, 28, 28); 
            border-radius: 5px;
            color: white;
            display: inline-block;
            font-weight: bold;
            padding: 12px 20px;
            text-align: center;
            text-decoration: none;
            width: auto; /* Ajusta el ancho al contenido */
            max-width: 250px;">
            Login With Google
        </a>
    </div>';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 40px;
        }

        .login-container {
            max-width: 400px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 48px rgba(0,0,0,0.40); /* Sombra más visible */
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600; /* Letra más gruesa */
        }

        input[type="submit"]:hover {
            background: #218838;
        }

        .google-login {
            display: flex;
            justify-content: center; /* Centers the button horizontally */
            margin-top: 20px;
        }

        .google-login a {
            background: #dd4b39;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            padding: 12px;
            text-align: center;
            text-decoration: none;
            width: 100%;
            max-width: 300px; /* Optional: limits the button width */
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Iniciar Sesión</h2>
    <form action="ingreso.php" method="POST">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" required>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>

        <input type="submit" value="Ingresar">
    </form>
    <div style="display: flex; gap: 10px; margin-top: 18px;">
        <a href="alta.php" style="
            flex: 1;
            text-align: center;
            background: #007bff;
            color: white;
            padding: 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
        ">Crear usuario</a>
        <a href="recuperar_clave.php" style="
            flex: 1;
            text-align: center;
            background: #ffc107;
            color: #212529;
            padding: 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
        ">Recuperar contraseña</a>
    </div>
    <div class="google-login">
        <?php
        if ($login_button == '') {
            echo '<div>Bienvenido, ' . $_SESSION['user_first_name'] . ' ' . $_SESSION['user_last_name'] . '</div>';
            echo '<div><img src="' . $_SESSION["user_image"] . '" style="border-radius: 50%; width: 100px; height: 100px; margin-top: 10px;"></div>';
            echo '<div><a href="logout.php" style="color: #007bff; text-decoration: none; margin-top: 10px; display: inline-block;">Cerrar sesión</a></div>';
        } else {
            echo $login_button;
        }
        ?>
    </div>
</div>

</body>
</html>
