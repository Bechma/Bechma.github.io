<?php
	require_once "pag_comun.php";
	require_once "templates/operaciones_db.php";
	HTMLinicio("Tienda");
	$conn = db_conectar();
	$res = $conn->query("SELECT * FROM discos");
	$lol = htmlspecialchars($_SERVER["PHP_SELF"]);
	$cambio = false;
	if(!isset($_COOKIE["tienda"]))
		setcookie("tienda", json_encode(array("Hola" => "bienvenido a mi tienda")), time()+3600);


	echo <<<HTML
	<h2 class="titulosh2">Tienda</h2>
HTML;

	
	echo <<<HTML

	<ul class="flex-container">
	
HTML;

	if( $res !== FALSE && $res->num_rows > 0){
		
		while ($row = $res->fetch_assoc() ){
			$nombre = urlencode($row["Nombre"]);
			
			if (isset($_POST[$nombre])){
				
				$array = json_decode(stripslashes($_COOKIE["tienda"]), true);
			
				if(isset($array[$row["Nombre"]])){
					$array[$row["Nombre"]] += $_POST[$nombre];
				} else {
					$array[$row["Nombre"]] = $_POST[$nombre];
				}
				setcookie("tienda", json_encode($array), time()+3600);
				$cambio=true;
			}
			echo <<<HTML
		
		<div class="flex-disco">
			<div><h2 class="centrar">{$row["Nombre"]}</h2></div>
			<div class="img"><img width="40%" src="{$row['Imagen']}" alt="Error cargar imagen"></div>
			<div><p class="centrar"><span class="texto-precio">Precio: </span>{$row['Precio']}€</p></div>
			<div class="centrar-boton">
			<form action="$lol" method="post">
				<label for="$nombre">Cantidad: </label>
				<input id="$nombre" type="text" name="$nombre"><br>
				<button type="submit" class="boton-carro" >
					<img class="icono" src="Imagenes/cart.png" width="10%">
					<span>Añadir al carrito</span>
				</button>
				</form>	
			</div>
		</div>
HTML;
		}
	}
	if($cambio == true){
		echo"<p class='correcto'>Carrito actualizado</p>";
	}
	
	echo " </ul>";
	HTMLfin();

?>