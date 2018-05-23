<?php
require_once "operaciones_db.php";

function opciones_gestor(){
	if ($_SESSION["tipo_user"] === "gestor"){
		$href = ["consulta", "historico", "precio", "logout"];
		$name = ["Consultar peticiones pendientes", "Consultar historico", "Editar precio discos", "Desconectarse"];
		echo '<div align="center">';
			echo '<div class="login">';
				echo "<ul>";
				foreach($href as $i => $val){
					echo "<li><a href='dashboard.php?accion=$val'>{$name[$i]}</a></li>";
				}
				echo "</ul>";
			echo "</div>";
		echo "</div>";
		acciones();
	}
}

function acciones(){
	if (isset($_REQUEST["accion"])){
		switch ($_REQUEST["accion"]){
			case "consulta":
				break;
			case "historico":
				break;
			case "precio":
				break;
			case "conciertos":
				break;
			default:
				echo "<p>Elija una opcion</p>";
				break;
		}
	} else echo "<p class='h1login'>Elija una opcion</p>";
}