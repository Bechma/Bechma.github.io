<?php
require_once "templates/operaciones_db.php";
require_once "pag_comun.php";
/**
 * Hacemos conexion a la base de datos para obtener los pertinentes datos de los componentes del grupo
 * que vamos a mostrar
 */
$conn = db_conectar();
if (!isset($_GET["miembro"])){
	$result = $conn->query("SELECT * FROM `miembros_grupo` LIMIT 0,1");//Limit: coge todas las primera columna de la tabla osea NOMBRE
	if ($result !== FALSE && $result->num_rows > 0){
		header("Location: {$_SERVER['PHP_SELF']}?miembro=".$result->fetch_assoc()["Roll"]); //??
		die();
	}
	else
	echo "<p class='error'>ERROR</p>";
}

if(isset($_GET["miembro"]))//en el caso de borrar BD no salga el error
{
	$miembro = $conn->real_escape_string($_GET["miembro"]);
	$miembro_row = $conn->query("SELECT * FROM `miembros_grupo` WHERE Roll='$miembro'");
}

HTMLinicio("Inicio");


if (isset($miembro) && $miembro_row !== FALSE && $miembro_row->num_rows === 1  ){
	$miembro_row = $miembro_row->fetch_assoc();
} else die();
?>
<h2 class="titulosh2" id="panel_control"> Inicio</h2>
<div class="estructura">
	<!-- COLUMNA DE LA IZQUIERDA
		En esta columna se mostrará el nombre del miembro del grupo seleccionado, 
		una foto del mismo, y una descripción biográfica-->
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
		
		
	
	<!-- COLUMNA DE LA DERECHA
		En esta columna se ofrece un menu con el nombre y rol de cada uno de los miembros del grupo
		de los que se puede seleccionar el deseado para obtener informacion-->
	</aside>
	<aside class="columDRCH">
		<h2>Miembros del Grupo</h2>
		
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
			<h2> Orígenes</h2>
			
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