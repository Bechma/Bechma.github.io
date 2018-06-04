<?php
require_once "pag_comun.php";
HTMLinicio("Biografia");
?>

<h2 class="titulosh2">Biografía</h2>
<div class="img">
	<img src="Imagenes/img2.jpg" alt="imagen no cargada">
</div>

<div class="estructura">

	<div class="parrafoBiblio">
		<?php
		require_once "templates/operaciones_db.php";
		$conn = db_conectar();
		$result = $conn->query("SELECT * FROM biografia");
		if ($result !== FALSE && $result->num_rows > 0){
			while ( $row = $result->fetch_assoc() )
				echo "<p>{$row["texto"]}</p>";
		}
		?>
	</div>
</div>

<?php HTMLfin() ?>
