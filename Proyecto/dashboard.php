<?php
require_once "templates/manejar_sesion.php";
if (!$esta_logueado){
	back2login();
} elseif (isset($_REQUEST["accion"]) && $_REQUEST["accion"] === "logout"){
	logout();
}

require_once "pag_comun.php";
HTMLinicio("Administracion");

if ($_SESSION["tipo_user"] === "admin"){
	require_once "templates/operaciones_admin.php";
	opciones_admin();
} elseif ($_SESSION["tipo_user"] === "gestor"){
	require_once "templates/operaciones_gestor.php";
	opciones_gestor();
} else {
	die("<p>ERROR, sesion invalida</p>");
}

HTMLfin();