<?php
require_once "pag_comun.php";
require_once "templates/operaciones_db.php";
HTMLinicio("Buscar");

$conn = db_conectar();

$result = $conn->query("SELECT * FROM conciertos");
$opciones = "";
while ($row = $result->fetch_assoc()){
	$fecha = date("d/m/Y", $row["Fecha"]);
	$hora = date("H:i", $row["Fecha"]);
	$valor = "$fecha $hora";
	if (isset($_POST["buscar_concierto"]) && $_POST["buscar_concierto"] === $row["Fecha"])
		$opciones .= "<option value='$valor' selected>$valor</option>\n";
	else
		$opciones .= "<option value='$valor'>$valor</option>\n";
}

//
// https://www.sitepoint.com/working-with-dates-and-times/
//



echo "<div align='center'>
<form action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='post'>
	<fieldset>
		<label for='nombre'>Buscar discos o canciones que contengan dicho nombre</label>
		<br>
		<input id='nombre' name='buscar_disco' value='".(isset($_POST["buscar_disco"]) ? $_POST["buscar_disco"] : "")."'>
		<br>
		<label for='fecha_disco'>Buscar discos publicados entre 2 fechas (introducir 2 años 'XXXX XXXX')</label>
		<br>
		<input id='fecha_disco' name='fecha_disco' value='".(isset($_POST["fecha_disco"]) ? $_POST["fecha_disco"] : "")."'>
		<br>
		<input type='submit' value='Buscar'>
	</fieldset>
</form>

<form action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='post'>
	<fieldset>
		<label for='concierto'>Selecciona la fecha del concierto a mostrar</label>
		<br>
		<select id='concierto' name='buscar_concierto[]' multiple>
			$opciones
		</select>
		<br>
		<label for='fecha_concierto'>Introduce 2 fechas para mostrar todos los conciertos entre dichas fechas</label>
		<br>
		<input id='fecha_concierto' name='fecha_concierto' value='".(isset($_POST["fecha_concierto"]) ? $_POST["fecha_concierto"] : "")."'>
		<br>
		<input type='submit' value='Buscar'>
	</fieldset>
</form>
</div>
<br>";

if (isset($_POST["buscar_concierto"])){
	echo "<table border='2' align='center'>
	<thead>
		<tr>
			<th>Fecha</th><th>Hora</th><th>Lugar</th><th>Descripcion</th>
		</tr>
	</thead>";
	foreach ($_POST["buscar_concierto"] as $value){
		$value = $timestamp = DateTime::createFromFormat('d/m/Y H:i', $value)->getTimestamp();
		$filtrado = $conn->real_escape_string($value);
		$result = $conn->query("SELECT * FROM conciertos WHERE Fecha='$filtrado'");
		if (isset($_POST["fecha_concierto"]) && $_POST["fecha_concierto"] !== "")
			$dates = preg_match(".*([0-9]{4}).*[0-9]{4}", $_POST["fecha_concierto"]);
		else
			$dates = [];
		while($row = $result->fetch_assoc()) {
			$fecha = date("d/m/Y", (int)$row["Fecha"]);
			$hora = date("H:i", (int)$row["Fecha"]);
			echo "
		<tr>
			<td>$fecha</td>
			<td>$hora</td>
			<td>{$row["Lugar"]}</td>
			<td>{$row["Descripcion"]}</td>
		</tr>";
		}
	}

	echo "</tbody>
</table>";
}

if (isset($_POST["fecha_disco"]) && $_POST["fecha_disco"] !== "") {
	preg_match("!.*([0-9]{4}).*([0-9]{4}).*!", $_POST["fecha_disco"], $dates);
	if(count($dates) === 3){
		$result_disco = $conn->query("SELECT * FROM discos");

		echo "<table border='2' align='center'>
	<thead>
		<tr><td colspan='4' align='center'>Discos</td></tr>
		<tr>
			<th>Nombre</th><th>Precio</th><th>FechaPublicacion</th><th>Descripcion</th>
		</tr>
	</thead>";

		while($row = $result_disco->fetch_assoc()) {
			if ($dates[1] <= $row["FechaPublicacion"] && $dates[2] >= $row["FechaPublicacion"] )
			echo "
		<tr>
			<td>{$row["Nombre"]}</td>
			<td>{$row["Precio"]}</td>
			<td>{$row["FechaPublicacion"]}</td>
			<td>{$row["Descripcion"]}</td>
		</tr>";
		}


		// Sacar resultados de las canciones encontradas
		echo "</tbody>
		</table>";
		HTMLfin();
		$conn->close();
		die();
	}
}
if (isset($_POST["buscar_disco"]) && $_POST["buscar_disco"] !== ""){
	$filtrado = $conn->real_escape_string($_POST["buscar_disco"]);
	$result_canciones = $conn->query("SELECT * FROM canciones WHERE Titulo LIKE '%$filtrado%'");
	$result_disco = $conn->query("SELECT * FROM discos WHERE Nombre LIKE '%$filtrado%'");

	// Sacar resultados de los discos encontrados
	echo "<table border='2' align='center'>
	<thead>
		<tr><td colspan='4' align='center'>Discos</td></tr>
		<tr>
			<th>Nombre</th><th>Precio</th><th>FechaPublicacion</th><th>Descripcion</th>
		</tr>
	</thead>";

	while($row = $result_disco->fetch_assoc()) {
		echo "
		<tr>
			<td>{$row["Nombre"]}</td>
			<td>{$row["Precio"]}</td>
			<td>{$row["FechaPublicacion"]}</td>
			<td>{$row["Descripcion"]}</td>
		</tr>";
	}


	// Sacar resultados de las canciones encontradas
	echo "</tbody>
</table>";

	echo "<table border='2' align='center'>
	<thead>
		<tr><td colspan='3' align='center'>Canciones</td></tr>
		<tr>
			<th>Titulo</th><th>Duracion</th><th>Disco</th>
		</tr>
	</thead>";

	while($row = $result_canciones->fetch_assoc()) {
		echo "
		<tr>
			<td>{$row["Titulo"]}</td>
			<td>{$row["Duracion"]}</td>
			<td>{$row["Disco"]}</td>
		</tr>";
	}

	echo "</tbody>
</table>";
}
$conn->close();
HTMLfin();