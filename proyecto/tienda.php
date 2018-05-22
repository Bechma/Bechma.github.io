<?php
	require_once "pag_comun.php";
	require_once "templates/operaciones_db.php";
	HTMLinicio("Tienda");
	$conn = db_conectar();
	$res = $conn->query("SELECT * FROM discos");
	echo <<<HTML
<h2 class="titulosh2">Tienda</h2>
	<ul class="flex-container">
HTML;

	if( $res !== FALSE && $res->num_rows > 0){
		while ($row = $res->fetch_assoc() ){
			echo <<<HTML
		<div class="flex-disco">
			<div><h2 class="centrar">{$row['Nombre']}</h2></div>
			<div class="img"><img width="40%" src="{$row['Imagen']}" alt="Error cargar imagen"></div>
			<div><p class="centrar"><span class="texto-precio">Precio: </span>{$row['Precio']}€</p></div>
			<div class="centrar-boton">
				<button class="boton-carro">
					<img class="icono" src="Imagenes/cart.png" width="10%">
					<span>Añadir al carrito</span>
				</button>
			</div>
		</div>
HTML;
		}
	}
	echo "</ul>";
	HTMLfin();