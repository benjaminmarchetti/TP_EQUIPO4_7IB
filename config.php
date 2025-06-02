<?php

//start session on web page
session_start();

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID | Copiar "Aqui tu ID DE CLIENTE"
$google_client->setClientId('548184883948-d0eu42hisua220f08nl9b2vk471lkavi.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key Aqui tu CLAVE
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI | URL AUTORIZADO
$google_client->setRedirectUri('http://localhost/inicio/accesocorrecto.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?>
