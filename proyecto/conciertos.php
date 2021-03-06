<?php
require_once "pag_comun.php";

require_once "templates/operaciones_db.php";

HTMLinicio("Conciertos");

echo '<h2 class="titulosh2"> Conciertos </h2>';
/**
 * Hacemos conexion a la base de datos para primeramente, 
 * obtener el numero de conciertos que tenemos y adaptar el pageSize
 */

$conn = db_conectar();

$sql = "select count(fecha) from conciertos";
$result = $conn->query($sql);
$row=$result->fetch_array(MYSQLI_NUM);
$nRows=$row[0];
$pageSize=600;
if(isset($_GET['pageSize'])){
	$pageSize=$_GET['pageSize'];
}
$page=0;
if(isset($_GET['page'])){
	$page=$_GET['page'];
}
$pos=$page*$pageSize;
$pos=($pos>$nRows)?$nRows:$pos;
/**
 * Hacemos de nuevo conexion a la base de datos, esta vez para obtener
 * todos los conciertos que haya en la base de datos y mostrarlos en su correspondiente tabla
 * En caso de que no haya conciertos que mostrar, se indicara con un mensaje
 */
$sql = "SELECT * FROM conciertos order by fecha";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo "<table border='2' align='center'>
	<tr>
		<th>Fecha</th><th>Hora</th><th>Lugar</th><th>Descripción</th>
	</tr>
	";
	while($row = $result->fetch_assoc()) {
		$fecha = date("d/m/Y", $row["Fecha"]);
		$hora = date("H:i", $row["Fecha"]);
		echo "<tr>";
		echo "<td>$fecha</td>";
		echo "<td>$hora</td>";
		echo "<td>".$row["Lugar"]."</td>";
		echo "<td>".$row["Descripcion"]."</td>";
		echo "</tr>";
	}
	echo "</table>";
} else {
	echo "No hay conciertos que mostrar";
}
$conn->close();

HTMLfin();

