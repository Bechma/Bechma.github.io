<?php
function db_conectar(){
	$servername = "localhost";
	$username = "mianbr1718";
	$password = "mA29PIX8";
	$dbname = "mianbr1718";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	return $conn;
}


function db_modificar_usuario(){
	if (isset($_POST["tipo"], $_POST["nombre"], $_POST["apellidos"], $_POST["email"], $_POST["password"], $_POST["telefono"])){
		$conn = db_conectar();

		$old_email = $conn->real_escape_string($_POST["usuarios_mod2"]);
		$nombre = $conn->real_escape_string($_POST["nombre"]);
		$apellidos = $conn->real_escape_string($_POST["apellidos"]);
		$email = $conn->real_escape_string($_POST["email"]);
		$password = preg_match('/^[a-f0-9]{32}$/',$_POST["password"]) ? $_POST["password"] : md5($_POST["password"]);
		$tipo = $conn->real_escape_string($_POST["tipo"]);
		$telefono = $conn->real_escape_string($_POST["telefono"]);

		$result = $conn->query("UPDATE usuarios SET Nombre='$nombre', Apellidos='$apellidos', Email='$email', Password='$password', Telefono='$telefono', TipoUser='$tipo' WHERE Email='$old_email'");
		$conn->close();
		return $result;
	}
	return "";
}


function db_insertar_usuario(){
	if (isset($_POST["nombre"], $_POST["apellidos"], $_POST["email"], $_POST["password"], $_POST["telefono"])
		&& $_SESSION["tipo_user"] === "admin"){

		if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
			return "email";
		}


		$conn = db_conectar();
		$tipo = (isset($_POST["tipo"]) && $_POST["tipo"] === "admin") ? "admin" : "gestor";
		$nombre = $conn->real_escape_string($_POST["nombre"]);
		$apellidos = $conn->real_escape_string($_POST["apellidos"]);
		$email = $conn->real_escape_string($_POST["email"]);
		$password = md5($_POST["password"]);
		$telefono = $conn->real_escape_string($_POST["telefono"]);

		$result = $conn->query("INSERT INTO usuarios VALUES ('$nombre', '$apellidos', '$email', '$password', '$tipo', '$telefono')");
		$conn->close();
		return $result;
	}
	return "";
}

function db_borrar_usuario($email){
	if ($_SESSION["tipo_user"] === "admin"){
		$conn = db_conectar();
		$email = $conn->real_escape_string($email);

		$result = $conn->query("DELETE FROM usuarios WHERE Email='$email'");
		$conn->close();
		return $result;
	}
	return "";
}