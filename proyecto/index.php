<?php
require_once "templates/operaciones_db.php";
require_once "pag_comun.php";
$conn = db_conectar();
if (!isset($_GET["miembro"])){
	$result = $conn->query("SELECT * FROM `miembros_grupo` LIMIT 0,1");//Limit: coge todas las primera columna de la tabla osea NOMBRE
	if ($result !== FALSE && $result->num_rows > 0){
		header("Location: {$_SERVER['PHP_SELF']}?miembro=".$result->fetch_assoc()["Roll"]); //??
		die();
	}
	else
	echo "ERROR";
}
$miembro = $conn->real_escape_string($_GET["miembro"]);
HTMLinicio("Inicio");

$miembro_row = $conn->query("SELECT * FROM `miembros_grupo` WHERE Roll='$miembro'");
if ($miembro_row !== FALSE && $miembro_row->num_rows === 1){
	$miembro_row = $miembro_row->fetch_assoc();
} else die();
?>
<h2 class="titulosh2" id="panel_control"> Inicio</h2>
<div class="estructura">
	<!-- COLUMNA DE LA IZQUIERDA-->
	<aside class="columIZQ">
		
			<h3><?php echo $miembro_row["Nombre"]?></h3>
			<div id="ImgIndex">
					<img src="<?php echo $miembro_row["Fotografia"]?>" alt="Imagen No ha cargado" width="60%" >
			</div>
			<div class="IndexParrafos">
			<p>
			<?php
				echo $miembro_row["Biografia"];
			?>
			</p>
			</div>
		
		
	
	<!-- COLUMNA DE LA DERECHA-->
	</aside>
	<aside class="columDRCH">
		<h2>Mienbros del Grupo</h2>
		
		<ul>
			<?php
			$result = $conn->query("SELECT * FROM `miembros_grupo`");
			if ($result !== FALSE && $result->num_rows > 0){
				while ( $row = $result->fetch_assoc() ){
					echo "<a href='".htmlentities($_SERVER['PHP_SELF'])."?miembro={$row['Roll']}#panel_control'><li>{$row['Roll']}</li></a>";
				}
			}
			?>
		</ul>
		
		<article>
			<h2> Origenes</h2>
			
			<div >
			<?php
				echo $miembro_row["Lugarnacimiento"];
			?>
			</div>
			<div >
			<?php
				echo $miembro_row["Fechanacimiento"];
			?>
			</div>
			


		</article>

	</aside>

</div>

<?php HTMLfin() ?>