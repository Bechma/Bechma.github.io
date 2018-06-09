<?php
//Iniciamos la sesion
session_start();
//Comprobamos que este definido el tipo de usuario, el email, los apellidos y el nombre
$esta_logueado = isset($_SESSION["email"], $_SESSION["tipo_user"], $_SESSION["apellidos"], $_SESSION["nombre"]);
/**
 * Esta funcion redirige al login
 */
function back2login(){
	header("Location: login.php");
	die();
}
/**
 * Esta funcion cierra la sesion, la destruye y redirige al login
 */
function logout(){
	session_unset();
	session_destroy();
	back2login();
}