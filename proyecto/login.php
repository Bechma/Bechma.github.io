<?php
require_once "templates/operaciones_db.php";
require_once "templates/manejar_sesion.php";
$error = "";

// Si el usuario ya estaba logueado se le manda a su panel de administracion
if ($esta_logueado){
	header("Location: dashboard.php#panel_control");
	die();
}

if (isset($_POST["email"]) && isset($_POST["password"])){
	// Me conecto a la base de datos
	$conn = db_conectar();

	// Filtro entradas de usuario
	$email = $conn->real_escape_string($_POST["email"]);
	$pass = md5($_POST["password"]);

	// Hago peticion
	$sql = "SELECT * FROM usuarios WHERE Email='$email' and Password='$pass'";
	$result = $conn->query($sql);

	//Si se encuentra al usuario, ajusto la sesion
	if ($result !== FALSE && $result->num_rows === 1){
		$row = $result->fetch_assoc();
		$_SESSION["nombre"] = $row["Nombre"];
		$_SESSION["apellidos"] = $row["Apellidos"];
		$_SESSION["email"] = $row["Email"];
		$_SESSION["tipo_user"] = $row["TipoUser"];
		$_SESSION["telefono"] = $row["Telefono"];

		// Registrar que se ha identificado el usuario
		db_log("Usuario con email: {$_SESSION['email']} y rol {$_SESSION['tipo_user']} se ha logueado");

		header("Location: dashboard.php#panel_control");
		die();
	} else {
		// Registrar intentos fallidos de login en el log
		db_log("Intento fallido de login: email=$email pass={$_POST['password']}");

		// Si no se encuentra al usuario se muestra un error
		$error = "<p class='error'>Error, usuario o contraseña incorrecto.</p>";
	}
}
require_once "pag_comun.php";
HTMLinicio("Login");
echo $error;
?>
<!-- Este es el formulario para el login -->
<div>
	<form id="panel_control" method="POST" action="login.php">
		<fieldset>
			<label for="email">Email:</label><br>
			<input type="text" id="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST["email"] ?>"><br>
			<label for="password">Password:</label><br>
			<input type="password" id="password" name="password"><br>
			<input type="submit">
		</fieldset>
	</form>
</div>

<?php HTMLfin() ?>