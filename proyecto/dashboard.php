<?php
require_once "templates/manejar_sesion.php";
/**
 * Si el usuario no esta logueado lo mandamos a la pantalla de login para que inicie sesion,
 * si esta logueado y la accion que ha seleccionado es logout, se realiza el logout
 */
if (!$esta_logueado){
	back2login();
} elseif (isset($_REQUEST["accion"]) && $_REQUEST["accion"] === "logout"){
	require_once "templates/operaciones_db.php";
	db_log("El usuario {$_SESSION['email']} ha hecho logout");
	logout();
}

require_once "pag_comun.php";
HTMLinicio("Login");
/**
 * Si el usuario de la sesion es de tipo admin, se caargan sus operaciones, si el usuario 
 * de la sesion es de tipo gestor, se cargan las operaciones del gestor. En otro caso se muestra 
 * mensaje de error
 */
if ($_SESSION["tipo_user"] === "admin"){
	require_once "templates/operaciones_admin.php";
	opciones_admin();
} elseif ($_SESSION["tipo_user"] === "gestor"){
	require_once "templates/operaciones_gestor.php";
	opciones_gestor();
} else {
	die("<p class='error'>ERROR: sesión invalida</p>");

}

HTMLfin();
