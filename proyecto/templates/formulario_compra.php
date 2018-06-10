<?php
	/**
	 * Se comprueba que el fichero que dirige a esta pagina sea carrito.php
	 */
	$checking = explode("/", $_SERVER["PHP_SELF"]);
	if (end($checking) !== "carrito.php"){
		die();
	}
	/**
	 * Dependiendo del error que haya se mostrara un mensaje de error o otro
	 */
	switch ($error){
		case "nombre": echo "<p class='error'>Rellena el nombre</p>"; break;
		case "apellidos": echo "<p class='error'>Rellena la casilla con tus apellidos</p>"; break;
		case "postal": echo "<p class='error'>Introduce una direccion postal valida</p>"; break;
		case "telefono": echo "<p class='error'>Introduce un telefono valido</p>"; break;
		case "mail": echo "<p class='error'>Introduce un email valido</p>"; break;
		case "pago": echo "<p class='error'>Indica cómo vas a pagar</p>"; break;
		case "numero_tarjeta": echo "<p class='error'>Numero de tarjeta invalido</p>"; break;
		case "tarjeta_caduca": echo "<p class='error'>Fecha de caducidad erronea</p>"; break;
		case "tarjeta_cvc": echo "<p class='error'>CVC malo</p>"; break;
		default: echo "";
	}
?>

<!-- Formulario de pedidos que debera de rellenar el usuario, este sera impreso mientras haya errores -->
<div id="panel_control" align="center">
<div class="login">
<form action="<?php echo htmlentities($_SERVER["PHP_SELF"]) ?>#myNav" method="post">
	<fieldset>
		<legend>Informacion personal</legend>

		<label for="nombre">Nombre</label>
		<input type="text" name="nombre" id="nombre"
			   value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre']; ?>">

		<label for="apellidos">Apellidos</label>
		<input type="text" name="apellidos" id="apellidos"
			   value="<?php if (isset($_POST['apellidos'])) echo $_POST['apellidos']; ?>">

		<label for="postal">Direccion postal</label>
		<input type="text" name="postal" id="postal"
			   value="<?php if (isset($_POST['postal'])) echo $_POST['postal']; ?>">
		<br>

		<label for="telefono">Telefono</label>
		<input type="tel" name="telefono" id="telefono"
			   value="<?php if (isset($_POST['telefono'])) echo $_POST['telefono']; ?>">
		<br>
		<label for="mail">Email</label>
		<input type="email" name="mail" id="mail"
			   value="<?php if (isset($_POST['mail'])) echo $_POST['mail']; ?>">

	</fieldset>

	<fieldset>
		<legend>Informacion sobre la suscripcion</legend>
		Método de pago:
		<label for="tarjeta">Tarjeta</label>
		<input type="radio" name="pago" value="tarjeta" id="tarjeta"
			<?php if (isset($_POST['pago']) && $_POST['pago'] === "tarjeta") echo "checked"; ?>>
		<label for="reembolso">Contra reembolso</label>
		<input type="radio" name="pago" value="reembolso" id="reembolso"
			<?php if (isset($_POST['pago']) && $_POST['pago'] === "reembolso") echo "checked"; ?>>
		<br>
		<label for="numero_tarjeta">Numero tarjeta</label>
		<input type="text" name="numero_tarjeta" id="numero_tarjeta"
			   value="<?php if (isset($_POST['numero_tarjeta'])) echo $_POST['numero_tarjeta']; ?>">
		<br>
		<label for="tarjeta_mes">mes</label>
		<input type="number" name="tarjeta_mes" id="tarjeta_mes" min="1" max="12"
			   value="<?php if (isset($_POST['tarjeta_mes'])) echo $_POST['tarjeta_mes']; ?>">
		<label for="tarjeta_anio">anio</label>
		<input type="number" name="tarjeta_anio" id="tarjeta_anio" min="2000" max="2050"
			   value="<?php if (isset($_POST['tarjeta_anio'])) echo $_POST['tarjeta_anio']; ?>">
		<label for="tarjeta_cvc">CVC</label>
		<input type="number" name="tarjeta_cvc" id="tarjeta_cvc"
			   value="<?php if (isset($_POST['tarjeta_cvc'])) echo $_POST['tarjeta_cvc']; ?>">
	</fieldset>

	<input type="hidden" name="tramitar" value="true">
	<input type="reset" value="Reiniciar">
	<input type="submit" name="formulario2" value="Enviar">
</form>
</div>
</div>
