<?php
require_once "templates/operaciones_db.php";
require_once "pag_comun.php";
$conn = db_conectar();
if (!isset($_GET["disco"])){
	$result = $conn->query("SELECT * FROM discos LIMIT 1,1");//Limit: coge todas las primera columna de la tabla osea NOMBRE
	if ($result !== FALSE && $result->num_rows > 0){
		header("Location: {$_SERVER['PHP_SELF']}?disco=".$result->fetch_assoc()["Nombre"]); //??
		die();
	}
}
$disco = $conn->real_escape_string($_GET["disco"]);
HTMLinicio("Discografia");

$disco_row = $conn->query("SELECT * FROM discos WHERE Nombre='$disco'");
if ($disco_row !== FALSE && $disco_row->num_rows === 1){
	$disco_row = $disco_row->fetch_assoc();
} else die();
?>

<h2 class="titulosh2" id="LIST"> Discografía</h2>

<div class="estructura">
	<!-- COLUMNA DE LA IZQUIERDA-->
	<aside class="columIZQ2">
		<h2><?php echo $disco_row["Nombre"] ." ({$disco_row["FechaPublicacion"]})"?></h2>
		<div class="img">
			<img width="50%" src="<?php echo $disco_row["Imagen"] ?>" alt="No se ha podido cargar imagen" >
		</div>
		<table border="2">
			<thead align="center" >
			<tr>
				<td colspan="3" align="center">Lista de canciones</td>
			</tr>
			<tr align="center" class="titulo">
				<th>Nº</th>
				<th>Título</th>
				<th>Duración</th>
			</tr>
			</thead>
			<tbody align="center">
			<?php
				$result = $conn->query("SELECT * FROM canciones WHERE Disco='$disco'");
				if ($result !== FALSE && $result->num_rows > 0){
					$i = 1;
					while( $row = $result->fetch_assoc()){
						echo "
						<tr>
							<th>$i</th>
							<th>".htmlentities($row["Titulo"])."</th>
							<th>".htmlentities($row["Duracion"])."</th>
						</tr>
						";
						$i++;
					}
				}
			?>
			</tbody>
		</table>
	</aside>
	<div class="DHparrafos">
		<p>
			<?php
				echo $disco_row["Descripcion"];
			?>
		</p>
	</div>
	<!-- COLUMNA DE LA DERECHA-->
	<aside class="columDRCH2"> <!-- Incorporar en cada parrafo una mini imagen de cada albun-->
		<h3>AC/DC ALBUMS</h3>
		<ul>
			<?php
			$result = $conn->query("SELECT * FROM discos");
			if ($result !== FALSE && $result->num_rows > 0){
				while ( $row = $result->fetch_assoc() ){
					echo "<a href='".htmlentities($_SERVER['PHP_SELF'])."?disco={$row['Nombre']}#LIST'><li>{$row['Nombre']}</li></a>";
				}
			}
			?>
		</ul>

	</aside>
</div>


<?php
$conn->close();
HTMLfin();
?>