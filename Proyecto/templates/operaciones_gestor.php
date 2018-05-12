<?php
require_once "operaciones_db.php";

function opciones_gestor(){
	if ($_SESSION["tipo_user"] === "gestor"){
		$href = ["consulta", "historico", "precio", "logout"];
		$name = ["Consultar peticiones pendientes", "Consultar historico", "Editar precio discos", "Desconectarse"];
		echo "<ul>";
		foreach($href as $i => $val){
			echo "<li><a href='dashboard.php?accion=$val'>{$name[$i]}</a></li>";
		}
		echo "</ul>";
	}
}