<?php
session_start();
$esta_logueado = isset($_SESSION["email"], $_SESSION["tipo_user"], $_SESSION["apellidos"], $_SESSION["nombre"]);

function back2login(){
	header("Location: login.php");
	die();
}

function logout(){
	session_unset();
	session_destroy();
	back2login();
}