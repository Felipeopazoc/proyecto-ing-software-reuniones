<?php


//$BASE_URL = "http://localhost/proyecto-ing-software-reuniones/";
$BASE_URL = "http://146.83.194.142/"
$LOGIN_URL = "login/backend/";
$REUNIONES_URL = "listado_reuniones/";
$COMENTARIOS_URL = "registrar_comentario/";
$VECINO_URL = "home_vecino/";
$DIRECTIVA_URL = "home_directiva/";

defined("TEMPLATES_PATH")
	or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/src/templates'));


defined("ACTAS_BACKEND_PATH")
	or define("ACTAS_BACKEND_PATH", realpath(dirname(__FILE__) . '/actas/backend'));


defined("LOGIN_BACKEND_PATH")
	or define("LOGIN_BACKEND_PATH", realpath(dirname(__FILE__) . '/login/backend'));
